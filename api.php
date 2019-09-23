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
	 * Make base directory easier to resolve
	 *
	 * @access public
	 * @return object
	 */
	public function Resolver():object
	{
		define( 'DIR' , __DIR__ );
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
		require( DIR . '/vendor/autoload.php' );
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
		/* Table */
		require( DIR . '/controllers/Table/table.loader.php' );

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
		require( DIR . '/providers/Header.php' );
		require( DIR . '/providers/Rest.php' );
		require( DIR . '/providers/DBControllers.php' );
		require( DIR . '/providers/Shared.php' );
		require( DIR . '/providers/Auth.php' );
		require( DIR . '/providers/Router.php' );
		return $this;
	}


}