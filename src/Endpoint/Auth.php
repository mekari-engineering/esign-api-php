<?php

namespace EsignApiPhp\Endpoint;

use EsignApiPhp\Configuration;
use GuzzleHttp\Client;
use Exception;

/**
 * Class Auth
 * 
 * This class provides methods for handling authentication with the eSign API.
 */
class Auth
{
    private static $instance;
    private static $baseUrl;
    private static $ssoUrl;

    /**
     * Auth constructor.
     * 
     * Initializes the base URL and SSO URL for the eSign API.
     */
    public function __construct()
    {
        self::$baseUrl = Configuration::getBaseUrl();
        self::$ssoUrl = Configuration::getSSOUrl();
    }

    /**
     * Get the instance of the Auth class.
     * 
     * @return Auth The instance of the Auth class.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the user authentication token.
     * 
     * @param string $code The authorization code.
     * @return array The user authentication token.
     * @throws Exception If an error occurs during the API request.
     */
    public function getUserAuthToken($code)
    {
        $url = self::$ssoUrl . 'auth/oauth2/token';
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => Configuration::$clientId,
            'client_secret' => Configuration::$clientSecret,
            'code' => $code,
        ];

        $client = new Client();

        $response = $client->post($url, [
            'form_params' => $data,
            'http_errors' => false
        ]);

        $status = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        if ($status === 200) {
            $data = json_decode($body, true);
            return $data;
        } else {
            $error = json_decode($body, true);
            $errorMessage = isset($error['message']) ? $error['message'] : 'Unknown error';

            if ($status === 400) {
                throw new Exception('Bad Request: ' . $errorMessage);
            } elseif ($status === 401) {
                throw new Exception('Unauthorized: ' . $errorMessage);
            } elseif ($status === 500) {
                throw new Exception('Internal Server Error: ' . $errorMessage);
            } else {
                throw new Exception('Error ' . $status . ': ' . $errorMessage);
            }
        }
    }

    /**
     * Get the refresh token.
     * 
     * @param string $refreshToken The refresh token.
     * @return array The refresh token.
     * @throws Exception If an error occurs during the API request.
     */
    public function getRefreshToken($refreshToken)
    {
        $url = self::$ssoUrl . 'auth/oauth2/token';
        $data = [
            'grant_type' => 'refresh_token',
            'client_id' => Configuration::$clientId,
            'client_secret' => Configuration::$clientSecret,
            'refresh_token' => $refreshToken,
        ];

        $client = new Client();

        $response = $client->post($url, [
            'form_params' => $data,
            'http_errors' => false
        ]);

        $status = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        if ($status === 200) {
            $data = json_decode($body, true);
            return $data;
        } else {
            $error = json_decode($body, true);
            $errorMessage = isset($error['message']) ? $error['message'] : 'Unknown error';

            if ($status === 400) {
                throw new Exception('Bad Request: ' . $errorMessage);
            } elseif ($status === 401) {
                throw new Exception('Unauthorized: ' . $errorMessage);
            } elseif ($status === 500) {
                throw new Exception('Internal Server Error: ' . $errorMessage);
            } else {
                throw new Exception('Error ' . $status . ': ' . $errorMessage);
            }
        }
    }
}
