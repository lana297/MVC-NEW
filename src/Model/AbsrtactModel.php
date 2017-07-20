<?php
namespace Model;

abstract class AbstractModel 
{
	protected $db;
	
	protected function getDb()
	{
		return $this->db;
	}
	
	public function setDb($db)
	{
		$this->db = $db;
	}
}

