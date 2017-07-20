<?php
namespace Controller;

abstract class AbstractController 
{
	protected $model;

	abstract public function index(); 

	protected function getModel()
	{
		return $this->model;
	}
	
	public function setModel($model)
	{
		$this->model = $model;
	}
	
	abstract public function display();
}