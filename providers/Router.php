<?php


namespace Ludndev\UrlShortener\API\Providers;


use \Phroute\Phroute\RouteCollector;
use \Phroute\Phroute\Dispatcher;


/**
* 
*/
class Router 
{


	protected $router;

	
	public function __construct()
	{
		$this->Initialize()->table();

		return $this;
	}


	public function table()
	{

		$this->router->get('/', function(){
		    return 'Home';
		});

		$this->router->get('/example', function(){
		    return 'This route responds to requests with the GET method at the path /example';
		});

		return $this;
	}


	public function Initialize()
	{
		$this->router = new RouteCollector();
		return $this;
	}


	public function Response()
	{
		$dispatcher =  new Dispatcher($this->router->getData());
		return $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	}


}








