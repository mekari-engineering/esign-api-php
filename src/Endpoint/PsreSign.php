<?php

namespace EsignApiPhp\Endpoint;

use EsignApiPhp\Configuration;
use GuzzleHttp\Client;
use Exception;

class PsreSign
{
    private static $instance;
    private static $baseUrl;

    public function __construct()
    {
        self::$baseUrl = Configuration::getBaseUrl();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Requests the PSRE sign for a document.
     *
     * @param string $doc The document to be signed.
     * @param string $filename The name of the document file.
     * @param array $signers An array of signers for the document.
     * @param int $signing_order The signing order for the signers.
     * @param string $callback_url The URL to receive callback notifications.
     * @param string $token The authentication token.
     * @return array The response data from the API.
     * @throws Exception If there is an error with the API request.
     */
    public function requestPsreSign($doc, $filename, $signers, $signing_order, $callback_url, $token)
    {
        $url = self::$baseUrl . 'documents/request_psre_sign';

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

    /**
     * Generates the signing URL for a specific document.
     *
     * @param string $documentId The ID of the document.
     * @param string $token The authentication token.
     * @return array The response data containing the signing URL.
     * @throws Exception If there is an error generating the signing URL.
     */
    public function generateSigningUrl($documentId, $token)
    {
        $url = self::$baseUrl . 'documents/' . $documentId . '/generate_signing_url';

        $headers = [
            'Authorization' => 'Bearer ' . $token
        ];

        $client = new Client();

        $response = $client->post($url, [
            'headers' => $headers
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