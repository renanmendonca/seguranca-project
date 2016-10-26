<?php

return [
	'mysql'=> function () {

		$isDevMode = false;

		$dbParams = 
			array 
				(
					'host'=>'localhost',
					'driver' => 'pdo_mysql',
					'user' => 'root',
					'password' => '',
					'dbname' => 'projeto'
				);

	},
	'html'=> function () {
		$options = [];
		$map = __DIR__.'/view';
		$view = new Core\Mvc\View\html($map);
		return $view;
	},
	'router'=> function () {
		if(!$_GET['request']) return;
		$urlArray = array();
	    $urlArray = explode("/",$_GET['request']);
	 
	    $controller = $urlArray[0];
	    array_shift($urlArray);
	    $action = $urlArray[0];
	    array_shift($urlArray);
	    $queryString = $urlArray;
	 
	    $controllerName = $controller;
	    $controller = ucwords($controller);
	    $controller .= 'Controller';
	    $model = rtrim($controller, 's');

		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	    if (!file_exists(__DIR__.'/src/App/Controllers/'.$controller.'.php')) {
		    echo "Rota não existe.";
		    exit();
		}
		
		//Testar se o método existe
		return (object) array('controller'=>$controller, 'action'=>$action);
	}
];