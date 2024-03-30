<?php

namespace EsignApiPhp\Endpoint;

use EsignApiPhp\Configuration;
use GuzzleHttp\Client;
use Exception;

/**
 * Class Stamping
 * 
 * This class provides methods for stamping documents using the eSign API.
 */
class Stamping
{
    private static $instance;
    private static $baseUrl;

    /**
     * Stamping constructor.
     * 
     * Initializes the base URL for API requests.
     */
    public function __construct()
    {
        self::$baseUrl = Configuration::getBaseUrl();
    }

    /**
     * Get the instance of the Stamping class.
     * 
     * @return Stamping The instance of the Stamping class.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Stamp a document.
     * 
     * @param string $doc The document to be stamped.
     * @param string $filename The filename of the document.
     * @param string $annotation The annotation for the stamp.
     * @param string $callback_url The callback URL for notifications.
     * @param string $token The access token for authentication.
     * 
     * @return array The response data from the API.
     * 
     * @throws Exception If an error occurs during the API request.
     */
    public function stamp($doc, $filename, $annotation, $callback_url, $token)
    {
        $url = self::$baseUrl . 'documents/stamp';

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ];

        $data = [
            'doc' => $doc,
            'filename' => $filename,
            'annotations' => $annotation,
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