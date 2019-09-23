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


}