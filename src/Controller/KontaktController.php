<?php
namespace Controller;

class KontaktController extends AbstractController
{

	public $twig;

	public function __construct($twig)
	{
		$this->twig = $twig;
	}

	public function index()
	{
		$this->display();
//var_dump( $this->model);
		$contacts = $this->model->getContacts();
		var_dump($contacts);

		var_dump("KontaktController::index");
	}

	public function showList()
	{
		var_dump("KontaktController::showList");
	}


	public function display()
	{

		/*echo $this->twig->render('hello.html', array(
								'name' => 'Lana',
								'college' => 'FOI',
								'year' => 3,

				'students' => array(
					array('name' => 'Pero', 'lastname' => 'Peric'),
					array('name' => 'Ivo', 'lastname' => 'Ivic'),
					array('name' => 'Marko', 'lastname' => 'Markic'))
			));*/

		//echo "works!";
	}


}