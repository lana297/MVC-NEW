<?php
namespace Helpers;

class Singleton
{
	/**
     * @param string $instance instance
     */
	protected static $instance = false;

	
	protected function __construct()
	{}
	
	protected function __clone()
	{}
	
	
	
	/**
	* get instance 
	*
	*@param string $sql, $host, $dbbase, $user, $pass  access data
	*
	$return $instance of getPDO
	*/
	public static function getInstance($sql, $dbhost, $dbbase, $dbuser, $dbpass)
	{

		if(empty(self::$instance)) 
		{
			self::$instance = self::getPDO($sql, $dbhost, $dbbase, $dbuser, $dbpass);
		}
		return self::$instance;
	}

	
	
	/**
	* Get PDO
	*
	*@param string $sql, $host, $dbbase, $user, $pass  access data
	*
	*@return instance of database class or die
	*/
	protected static function getPDO($sql, $host, $dbbase, $user, $pass)
	{

		try
		{
			$conn = new Db ($sql, $host, $dbbase, $user, $pass);
		}
		catch (PDOexception $e) 
		{
			print "Error!: " .$e->getMessage() . "</br>";
			die();
		}
		return $conn;
	}
	
	protected function __destruct()
	{
	}	
}


