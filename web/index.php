<?php

require('../config/config.php');
require('../vendor/autoload.php');

$loader = new Twig_Loader_Filesystem(WEB_ROOT.'\templates');
$twig = new Twig_Environment($loader);






/*echo $twig->render('hello.html', array(
								'name' => 'Lana',
								'college' => 'FOI',
								'year' => 3,
					
				'students' => array(
					array('name' => 'Pero', 'lastname' => 'Peric'),
					array('name' => 'Ivo', 'lastname' => 'Ivic'),
					array('name' => 'Marko', 'lastname' => 'Markic'))	
			));*/

								
								
								
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}



$url = $_SERVER['REQUEST_URI'];

$output = "";
$works = true;

while ($works)
{
	$path= explode("/",$url);
	$pop = array_pop($path);
	$fullPath = $_SERVER['REQUEST_SCHEME']. "://" . $_SERVER['HTTP_HOST'] . implode("/", $path);
	$output = $pop ."/". $output;
	$url = str_lreplace("/".$pop, "", $url);
	
	if (strcmp($fullPath, DOC_ROOT) == 0)
	{
		$works = false;
	}
}

	$output = str_lreplace("/", "", $output);
	if (strripos($output, "?") == false)
	{
		$output = $output;
	}
	else
	{
		$lastOccurance = strripos($output, "?");
		$output = substr($output, 0, $lastOccurance);
	}


use Helpers\App;
$app = new App($output,$twig); 


