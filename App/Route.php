<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'AuthController',
			'action' => 'login'
		);

		$routes['logout'] = array(
			'route' => '/logout',
			'controller' => 'AuthController',
			'action' => 'logout'
		);

		$routes['list'] = array(
			'route' => '/list',
			'controller' => 'AppController',
			'action' => 'list'
		);

		$routes['enroll'] = array(
			'route' => '/enroll',
			'controller' => 'AppController',
			'action' => 'enroll'
		);
		
		$routes['delete'] = array(
			'route' => '/delete',
			'controller' => 'AppController',
			'action' => 'delete'
		);

		$this->setRoutes($routes);
	}

}

?>