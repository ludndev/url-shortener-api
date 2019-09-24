<?php


namespace Ludndev\UrlShortener;


/**
 * API Class
 *
 * Main class of API Package
 * 
 * @package    Url Shortener
 * @subpackage API
 * @author     Ludndev < ludndev@gmail.com >
 */
class API 
{

	/**
	 * Temporaly store error message
	 *
	 * @access protected
	 * @var string $errorMessage
	 */
	protected $errorMessage;


	/**
	 * API Constructor
	 *
	 * @access public
	 * @return object
	 */
	public function __construct()
	{
		return $this;
	}


	/**
	 * Resolve and init some required 'tools'
	 *
	 * @access public
	 * @return object
	 */
	public function Loader():object
	{
		return 
			$this->Composer()
				 ->Resolver()
				 ->Providers()
				 ->Controllers();
	}


	/**
	 * Make some action more easier and global
	 *
	 * @access public
	 * @return object
	 */
	public function Resolver():object
	{
		/* resolve and set base directory as DIR */
		define( 'DIR' , __DIR__ );

		/* load .env data */
		$dotenv = \Dotenv\Dotenv::create( __DIR__ );
		$dotenv->load();

		return $this;
	}


	/**
	 * Initialize composer packages
	 *
	 * @access public
	 * @return object
	 */
	public function Composer():object
	{
		require( __DIR__ . '/vendor/autoload.php' );
		return $this;
	}


	/**
	 * Initialize controllers
	 *
	 * @access public
	 * @return object
	 */
	public function Controllers():object
	{
		$loaders = \Ludndev\UrlShortener\API\Providers\Shared::ControllersLoader();
		foreach ($loaders as $loader) {
			require( __DIR__ . "/controllers/Table/$loader" );
		}
		return $this;
	}


	/**
	 * Initialize providers
	 *
	 * @access public
	 * @return object
	 */
	public function Providers():object
	{
		require( __DIR__ . '/providers/Header.php' );
		require( __DIR__ . '/providers/Rest.php' );
		require( __DIR__ . '/providers/Response.php' );
		require( __DIR__ . '/providers/DBController.php' );
		require( __DIR__ . '/providers/Shared.php' );
		require( __DIR__ . '/providers/Auth.php' );
		require( __DIR__ . '/providers/Router.php' );
		return $this;
	}


	/**
	 * Set response content : case of throwed error
	 *
	 * @access public
	 * @return void
	 */
	public function SetError(string $message):void
	{
		$this->errorMessage = $message;
	}


	/**
	 * Return JSON response
	 *
	 * @access public
	 * @return string
	 */
	public function Response():string
	{
		$router = new \Ludndev\UrlShortener\API\Providers\Router();

		if ( !empty(trim($this->errorMessage)) ) {
			$json = $this->errorMessage;
			$this->errorMessage = '';
		} else {
			$json = $router->Export();
		}
		
		return $json;
	}

}