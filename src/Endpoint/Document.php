<?php

namespace EsignApiPhp\Endpoint;

use EsignApiPhp\Configuration;
use GuzzleHttp\Client;
use Exception;

class Document
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

    public function getDocumentList($page, $limit, $token, $category = null, $signing_status = null, $stamping_status = null)
    {
        $url = self::$baseUrl . 'documents';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        $params = [
            'page' => $page,
            'limit' => $limit
        ];

        if ($category !== null) {
            $params['category'] = $category;
        }

        if ($signing_status !== null) {
            $params['signing_status'] = $signing_status;
        }

        if ($stamping_status !== null) {
            $params['stamping_status'] = $stamping_status;
        }

        $client = new Client();

        $response = $client->get($url, [
            'headers' => $headers,
            'query' => $params
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

    public function getDocumentDetail($documentId, $token)
    {
        $url = self::$baseUrl . 'documents/' . $documentId;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        $client = new Client();

        $response = $client->get($url, [
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

    public function downloadDocument($documentId, $token)
    {
        $url = self::$baseUrl . 'documents/' . $documentId . '/download';

        $headers = [
            'Authorization' => 'Bearer ' . $token
        ];

        $client = new Client();

        $response = $client->get($url, [
            'headers' => $headers
        ]);

        $status = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        if ($status === 200) {
            return $body;
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

    public function resendDocument($documentId, $token)
    {
        $url = self::$baseUrl . 'documents/' . $documentId . '/resend';

        $headers = [
            'Content-Type' => 'application/json',
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

    public function voidDocument($documentId, $token, $reason)
    {
        $url = self::$baseUrl . 'documents/' . $documentId . '/void';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        $data = [
            'reason' => $reason
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

    public function deleteDocument($documentId, $token)
    {
        $url = self::$baseUrl . 'documents/' . $documentId . '/delete';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];

        $client = new Client();

        $response = $client->delete($url, [
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