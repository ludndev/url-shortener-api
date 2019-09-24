<?php


require( __DIR__ . './../api.php' );


try {


	$api = new Ludndev\UrlShortener\API();

	/* load api */
	$api->Loader();

    /* connect to database */
	$db = new Ludndev\UrlShortener\API\Providers\DBController(
        $_ENV['DB_DRIVER'],
        $_ENV['DB_HOST'],
        $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
        ]
    );


} catch (Exception $error) {

    /* catch error message or code */
	$api->SetError( $error->getMessage() );
	
} finally {

    /* display JSON response */
	echo $api->Response();

}




