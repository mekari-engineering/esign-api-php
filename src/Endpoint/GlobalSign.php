<?php

namespace EsignApiPhp\Endpoint;

use EsignApiPhp\Configuration;
use GuzzleHttp\Client;
use Exception;

/**
 * Class GlobalSign
 * 
 * This class represents the GlobalSign endpoint of the eSign API.
 * It provides methods to request a global sign for a document.
 */
class GlobalSign
{
    private static $instance;
    private static $baseUrl;

    /**
     * GlobalSign constructor.
     * 
     * Initializes the base URL for the API.
     */
    public function __construct()
    {
        self::$baseUrl = Configuration::getBaseUrl();
    }

    /**
     * Get the instance of the GlobalSign class.
     * 
     * @return GlobalSign The instance of the GlobalSign class.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Request a global sign for a document.
     * 
     * @param string $doc The document to be signed.
     * @param string $filename The name of the document file.
     * @param array $signers The list of signers for the document.
     * @param int $signing_order The signing order for the document.
     * @param string $callback_url The callback URL for receiving notifications.
     * @param string $token The access token for authentication.
     * 
     * @return array The response data from the API.
     * 
     * @throws Exception If an error occurs during the API request.
     */
    public function requestGlobalSign($doc, $filename, $signers, $signing_order, $callback_url, $token)
    {
        $url = self::$baseUrl . 'documents/request_global_sign';

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];

        $data = [
            'doc' => $doc,
            'filename' => $filename,
            'signers' => $signers,
            'signing_order' => $signing_order,
            'callback_url' => $callback_url
        ];

        $client = new Client();

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $data
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