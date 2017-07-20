<?php
namespace Helpers;

class QueryBuilder
{
	private $sql = null;
	
	/**
     * @something array
     */
	private $something = array('select' =>    array(),
								'from' =>     array(),
								'join' =>     array(),
								'where'=>     array(), 
								'group_by' => array(), 
								'having' =>   array(),
								'order_by' => array(),
								'limit' =>    "",
								'offset' =>   "");

	/**
	* Get select
	* @return $this
	*/
	
	public function getSelect()
	{
		return $this->something['select'];
	}

	/**
	* Get from
	* @return $this
	*/
	public function getFrom()
	{
		return $this->something['from'];
	}
	/**
	* Get join
	* @return $this
	*/
	public function getJoin()
	{
		return $this->something['join'];
	}
	/**
	* Get where
	* @return $this
	*/
	public function getWhere()
	{
		return $this->something['where'];
	}
		
	/**
	* Get groupby
	* @return $this
	*/
	public function getGroupby()
	{
		return $this->something['group_by'];
	}
	/**
	* Get having
	* @return $this
	*/
	public function getHaving()
	{
		return $this->something['having'];
	}
	/**
	* Get orderby
	* @return $this
	*/	
	public function getOrderby()
	{
		return $this->something['order_by'];
	}
	/**
	* Get limit
	* @return $this
	*/	
	public function getLimit()
	{
		return $this->something['limit'];
	}
	/**
	* Get offset
	* @return $this
	*/	
	public function getOffset()
	{
		return $this->something['offset'];
	}

	

	/**
	* set select
	*
	*@param array $data defines fields
	*
	*@return $this
	*/
	public function setSelect(array $data = array("*")) 
	{
		 $this->something['select'][] = $data;
		 
		 return $this;
	}
	
	/**
	* set table
	*
	*@param array $data defines fields
	*
	*@return $this
	*/
	public function setFrom(array $data)
	{
		$this->something['from'][] = $data;
		return $this;
	}

	
	/**
	* set join
	*
	*@param string $table $param $type
	*@param null $mparam
	*
	*@return $this
	*/
	public function setJoin($table, $param, $type = "INNER", $mparam = null)
	{
		$this->something['join'][] = array('table' => $table, 'param' => $param, 'type' => $type, 'mparam' => $mparam);
		return $this;
	}
	
	/**
	* set where
	*
	*@param array 
	* @string $prefix
	*
	*@return $this
	*/
	public function setWhere(array $data, $prefix = "AND")
	{
		$this->something['where'][] = array ('prefix' => $prefix, 'data' => $data);
		return $this;
	}
	
	/**
	* set groupby
	*
	*@param array @data
	*
	*@return $this
	*/
	public function setGroupby(array $data)
	{
		$this->something['group_by'][] = $data;
		return $this;
	}

	public function setHaving($data)
	{
		$this->something['having'][]= $data;
		return $this;
	}
	
	/**
	* set orderby
	*
	*@param string $column, $order = ASC
	*
	*@return $this
	*/
	public function setOrderby($column, $order = "ASC")
	{
		 $this->something['order_by'][] = $column  . " " . $order;
		return $this;
	}
	
	/**
	* set limit
	*
	*@param string $cond
	*
	*@return $this
	*/
	public function setLimit($cond)
	{
		$this->something['limit'] = $cond;
		return $this;
	}
	
	/**
	* set offset
	*
	*@param string $cond
	*
	*@return $this
	*/
	public function setOffset($cond)
	{
		 $this->something['offset'] = $cond;
		return $this;		 
	}
	
	
////////////////////////////////////////////////////////////////////	
	/**
	* get sql
	*
	*@param string $select $from $join $where $order $limit $offset
	*
	*@return $this / generated query
	*/
	public  function getSQL()
	{
		$this->sql = "";
		
		/////////////SELECT///////////////// 
		$select = "SELECT ";
		foreach($this->getSelect() as $value)
		{
			$select .= implode(",", $value). ',';
		}
		$this->sql .= rtrim($select, ",");

		
		///////////FROM////////////////
		$from = " FROM ";
		foreach($this->getFrom() as $f) 
		{
			$from .= implode(",", $f). ',';
		}
		$this->sql .= rtrim($from, ",");

		
		////////////////join///////////////
		if(!empty($this->something['join']))
		{	
		$join = " INNER JOIN";
		foreach($this->getJoin() as $key => $j) 
		{
			$join .= " ". $j['table']. " ON " .$j['param'] ; 
		}
		$this->sql .= $join;
		}

		
		////////////////WHERE//////////////
		if(!empty($this->something['where']))
		{	
		$where = " WHERE 1 ";
		foreach($this->getWhere() as $w)
		{
			$where .= $w['prefix'];
			foreach($w['data'] as $key => $value)
			{
				$where .= " " . $key . $value;
			}
		}
			$this->sql .= $where;
		}	

		
		///////////////ORDER BY////////////////
		
		if(!empty($this->something['order_by']))
		{
		$order = " ORDER BY ";
		foreach($this->getOrderby() as $o)
		{
			$order .= $o. ",";
		}
		$this->sql .= rtrim($order, ",");
		}

		
		///limits///	
		if(!empty($this->something['limit']))
		{
		$limit = " LIMIT ".$this->getLimit();
		$this->sql .= $limit;
		}

		
		////offset
		if(!empty($this->something['offset']))
		{
			$offset = " OFFSET ".$this->getOffset();
			$this->sql .= $offset;
		}
		
			return $this->sql;
	}
	
}