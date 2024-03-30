<?php
namespace EsignApiPhp;

use EsignApiPhp\Endpoint;

class EsignApiClient
{
    public function __construct($clientId, $clientSecret, $production = false)
    {
        Configuration::$clientId = $clientId ? $clientId : Configuration::$clientId;
        Configuration::$clientSecret = $clientSecret ? $clientSecret : Configuration::$clientSecret;
        Configuration::$production = $production ? $production : Configuration::$production;
    }

    public function auth()
    {
        return Endpoint\Auth::getInstance();
    }

    public function globalSign()
    {
        return Endpoint\GlobalSign::getInstance();
    }

    public function psreSign()
    {
        return Endpoint\PsreSign::getInstance();
    }

    public function stamping()
    {
        return Endpoint\Stamping::getInstance();
    }
}