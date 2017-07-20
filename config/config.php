<?php


DEFINE('WEB_ROOT', getcwd());


$path = explode("/",str_replace($_SERVER['HTTP_HOST'],"",$_SERVER['SCRIPT_NAME']));
array_pop($path);
$fullPath = $_SERVER['REQUEST_SCHEME']. "://" . $_SERVER['HTTP_HOST'] . implode("/", $path);
DEFINE('DOC_ROOT', $fullPath);



$froot = explode("\\", __DIR__);
array_pop($froot);
$fullfr = implode ("\\", $froot);
DEFINE('FILE_ROOT', $fullfr);



DEFINE('dbHOST', 'localhost');
DEFINE('dbUSER', 'iwa_2015');
DEFINE('dbPASS', 'foi2015');
DEFINE('dbBASE', 'iwa_2015_zb_projekt');

//DEFINE('dbUSER', 'root');
//DEFINE('dbPASS', '');

DEFINE('dbENGINE', 'mysql');




