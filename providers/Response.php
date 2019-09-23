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
	 * @param bool $status
	 * @param string $message
	 * @param array $data
	 * @return string
	 */
	protected function Response(bool $status, string $message, array $data):string
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
	public static function Success(array $data = [], string $message = ''):string
	{
		return $this->Response( TRUE , $message , $data );
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
	public static function Failed(string $message = ''):string
	{
		return $this->Response( FALSE , $message , [] );
	}


}