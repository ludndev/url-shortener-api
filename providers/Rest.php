<?php


namespace Ludndev\UrlShortener\API\Providers;


use \Ludndev\UrlShortener\API\Providers\Header;
use \Exception;


/**
* 
*/
class Rest extends Header
{


	/**
	 * Available methods
	 *
	 * @access protected
	 * @var array $allowMethods
	 */
	protected $allowMethods = [
		'GET',
		'PUT',
		'POST',
		'DELETE'
	];
	

	/**
	 * Contruct Restfull Headers
	 *
	 * @access public
	 * @param string $method
	 * @param int $age
	 * @todo Document link for each Header function, PhP official link
	 * @return void
	 */
	public function __construct(string $method, int $age = 3600)
	{
		$method = strtoupper($method);
		/* minimal headers , they should always be there */
		$this->SetJson();
		$this->SetOrigin('*');
		$this->SetAge(3600);
		/* check and set method */
		$this->CheckMethod($method);
		$this->SetMethod($method);
		/* special headers required by method */
		$this->SpecialHeader($method);
	}


	/**
	 * Allow only selected methods
	 *
	 * @access protected
	 * @param string $method
	 * @throws UNALLOWED_METHOD
	 * @return void
	 */
	protected function CheckMethod(string $method):void
	{
		if ( !in_array($method, $this->allowMethods) )
			throw new Exception("UNALLOWED_METHOD", 1);
	}


	/**
	 * Some headers according to the current method
	 *
	 * @access protected
	 * @param string $DSN
	 * @return void
	 */
	protected function SpecialHeader(string $method):void
	{
		switch ($method) {
			case 'POST':
				$this->SetHeaders("Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
				break;

			case 'GET':
				$this->SetCredentials(TRUE);
				break;
		}
	}


	/**
	 * Set request status
	 *
	 * @access public
	 * @param int $code
	 * @throws UNDEFINED_HTTP_CODE
	 * @return void
	 */
	public function Status(int $code):string
	{
		$http = $this->SetHTTPStatus($code);

		if ( $http['code'] === 0 )
			throw new Exception($http['error'], 1);

		return $http['error'];
	}


}