<?php


namespace Ludndev\UrlShortener\API\Providers;


/**
* 
*/
class Response
{


	/**
	 * Set and format response as JSON
	 *
	 * @access protected
	 * @static
	 * @param bool $status
	 * @param string $message
	 * @param array $data
	 * @return string
	 */
	protected static function Response(bool $status, string $message, array $data):string
	{
		return 
			json_encode([
				'status' => $status,
				'message' => $message,
				'data' => $data
			]);
	}


	/**
	 * Set success response
	 *
	 * @access public
	 * @static
	 * @param array $data
	 * @param string $message
	 * @return string
	 */
	public static function Success(string $message = 'SUCCESS', array $data = []):string
	{
		return self::Response( TRUE , $message , $data );
	}


	/**
	 * Set failed response
	 *
	 * @access public
	 * @static
	 * @param array $data
	 * @param string $message
	 * @return string
	 */
	public static function Failed(string $message):string
	{
		return self::Response( FALSE , $message , [] );
	}


}