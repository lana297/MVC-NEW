<?php
namespace Helpers;

use Twig\lib\twig;

class App 
{
	public $requestedPath;
	public $routes;
	public $activeModel;
	public $activeController;
	public $control;
	public $twig;
	

	public function __construct($ispis, $twig) 
	{

		//var_dump(get_declared_classes());
		
		/*$loader = new Twig\Loader\Twig_Loader_Filesystem(WEB_ROOT.'\templates');
		$twig = new Twig_Environment($loader);*/
		
		$this->twig = $twig;
		
		/*echo $this->twig->render('hello.html', array(
								'name' => 'Lana',
								'college' => 'FOI',
								'year' => 3,
					
				'students' => array(
					array('name' => 'Pero', 'lastname' => 'Peric'),
					array('name' => 'Ivo', 'lastname' => 'Ivic'),
					array('name' => 'Marko', 'lastname' => 'Markic'))	
			));*/
		
		$this->setRequestedPath($ispis);
		$this->setRoutes();
		
		$reqController = $this->routeMatching();
		$this->control = null;
		$method = null;
		
		var_dump($reqController);
		
		@list($this->control, $method) = explode("::", $reqController);
		
	$this->model();
		$this->controller($this->twig);
		
	
		if($method == NULL)
		{
			$method = "index";
		}
		
		return $this->activeController->$method();
	}
	
	public function model()
	{
		$modelName = 'Model\\'.$this->control."Model";
		$this->activeModel = new $modelName();
		$db = Singleton::getInstance(dbENGINE, dbHOST, dbBASE, dbUSER, dbPASS);
		$this->activeModel->setDB($db);
	}
	
	public function controller($twig)
	{
		$controllerName = 'Controller\\'.$this->control."Controller";
		$this->activeController = new $controllerName($twig);
		$this->activeController->setModel($this->activeModel);
	}
	
/////////////////////////////////////////////////////////////		
	public function getRequestedPath()
	{
		return $this->requestedPath;
	}
	
	public function getRoutes()
	{
		return $this->routes; 
	}
	
	public function setRequestedPath($requestedPath)
	{
		$this->requestedPath = $requestedPath;
	}
	
	public function setRoutes()
	{
		require_once(FILE_ROOT."/config/routing.php");
		$this->routes = $routes;
	}
	
	
	
	public function routeMatching()
	{
		$r_path = $this->getRequestedPath();
		$routes = $this->getRoutes();
		
		
		foreach($routes as $key => $v)
		{
			if($key == $r_path)
			{
				return $v;
			}
		}
	}
}
