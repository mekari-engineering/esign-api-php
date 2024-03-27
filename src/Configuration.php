<?php

namespace EsignApiPhp;

class Configuration
{
    public static $production = false;
    private static $productionBaseUrl = 'https://api.mekari.com/v2/esign/v1/';
    private static $sandboxBaseUrl = 'https://sandbox-api.mekari.com/v2/esign/v1/';
    private static $ssoSandboxUrl = 'https://sandbox-account.mekari.com/';
    private static $ssoProductionUrl = 'https://account.mekari.com/';
    public static $clientId = '';
    public static $clientSecret = ''; 

    public static function getBaseUrl()
    {
        if (self::$production) {
            return self::$productionBaseUrl;
        } else {
            return self::$sandboxBaseUrl;
        }
    }

    public static function getSSOUrl()
    {
        if (self::$production) {
            return self::$ssoProductionUrl;
        } else {
            return self::$ssoSandboxUrl;
        }
    }
    
    
}