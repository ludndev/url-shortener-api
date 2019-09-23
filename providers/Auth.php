<?php


namespace Ludndev\UrlShortener\API\Providers;


use Ludndev\UrlShortener\API\Providers\DBController;
use \Exception;


/**
* 
*/
class Auth 
{
    

    public function __construct(string $identifiant, string $accessKey, string $type = 'direct')
    {
        # identifiant => email / domain 
        # accessKey => password, apiKey
    }


    public function CheckAuthType(string $type)
    {
        if ( strtolower($type) !== 'direct' && strtolower($type) !== 'http' )
            throw new Exception("UNDEFINED_AUTHENTICATION_TYPE", 1);
    }


    public function DirectAuth(string $identifiant, string $accessKey)
    {
        global $db;
    }


    public function HTTPAuth(string $identifiant, string $accessKey)
    {
        if ( !isset($_SERVER["HTTP_AUTHORIZATION"]) || stripos($_SERVER["HTTP_AUTHORIZATION"], 'basic ') !== 0 ) 
        response( [ FALSE , 'AUTH_FIRST' ] );

        $credentials = explode(':', base64_decode(substr($_SERVER["HTTP_AUTHORIZATION"], 6)), 2);

        if ( count($credentials) !== 2 ) 
            response( [ FALSE , 'UNREGULAR_DATA_SENT' ] );

        if ( $credentials[0] !== 'localhost' || $credentials[1] !== 'public_api_key' ) 
            response( [ TRUE , 'BAD_CREDENTIALS' ] );

        $data = [ 'one' , 'datum'];

        response( [ TRUE , 'AUTH_SUCCESS' ] , $data , FALSE );
    }


}