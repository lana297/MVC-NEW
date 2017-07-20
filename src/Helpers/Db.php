<?php
namespace Helpers;

class Db extends \PDO
{

	/**
	* Set requirements for db access
	*
	*@param string $sql, $host, $dbbase, $user, $pass  access data
	*
	*/
	public function __construct($sql, $host, $dbbase, $user, $pass)
	{
		try
		{
			$dns = $sql.':dbname='.$dbbase.";host=".$host;
			parent::__construct( $dns, $user, $pass);
		}
		catch(PDOexception $e)
		{
			echo "Database error: Connecting error.</br>".$e->getMessage();
			exit;
		}
	}

	public function query($sql)
	{
		//funkcija za execute querya
		//dodatne funkcije: insert, update, delete
		//npr ua update na kraju pooves funkciju query za execute

        $result = parent::query($sql, parent::FETCH_ASSOC);
        return $result->fetchAll();

	}


	/**
     * Method for inserting values into a table
     *
     * @param   string  $table table the table to insert into
     * @param   array   $values to insert e.g.
     *                  array ('username' => 'test',
     *                         'password' => md5('test'))
     * @return  boolean $res true on success or false on failure
     */
    public function insert($table, $values)
	{
        $fieldnames = array_keys($values);
        $sql = "INSERT INTO $table";
        $fields = '( ' . implode(' ,', $fieldnames) . ' )';
        $bound = '(:' . implode(', :', $fieldnames) . ' )';
        $sql .= $fields.' VALUES '.$bound;

		return $this->query($sql);
    }

	/**
     * Function for updating a row in a table
     *
     * @param   string  $table the table to update
     * @param   array   $values which should be updated e.g.:
     *                  array ('username' => 'test', 'password' => md5('test')
     * @param   mixed   $search primary id of row (need to have an id in table or
     *                  array ('username' => 'test')
     * @return  boolean $res true on success and false on failure
     */
    public function update($table, $values, $search, $bind = null)
	{
        $sql = "Update `$table` SET ";

        foreach ($values as $field => $value )
		{
            $ary[] = " `$field`=" . ":$field ";
        }

        $sql.= implode (',', $ary);
        $sql.= " WHERE ";

        if (is_array($search))
		{
            foreach ($search as $key => $val)
			{
                //array('username' => 1, $key => '2343');
                $params[] ="`$key`= " . $val;
            }
            $params = implode(' AND ', $params);
            $sql .= $params;
        } 
		else 
		{
            $search = $search;
            $sql.= " `id` = $search";
        }

		return $this->query($sql);

    }

	/**
     * Method for deleting from a database table. If $fieldname is
     * a string e.g. an id then $search will be used to find which row to delete
     * e.g. '3' which should be set in $search. If $search is an array you can
     * add more conditions, e.g. array ('id' => 3, 'title' => 'test');
     *
     * @param   string  $table the database table to delete from .e.g. auth
     * @param   mixed   $fieldname the where clause e.g. where 'id' =
     * @param   mixed   $search sets a simple search option. e.g. '3'. It can
     *                  also be an array like this: array ('id' => 3)
     *                  delete from 'auth' Where id = 3
     * @return  boolean true on succes or false on failure
     */
    public function delete($table, $fieldname, $search)
	{
        $sql = "DELETE FROM `$table` WHERE ";

        if (is_array($search))
		{
            foreach ($search as $key => $val)
			{
                $params[] ="`$key`= " . $val;
            }
            $params = implode(' AND ', $params);
            $sql .= $params;
        }
		else
		{
            $sql .= " `$fieldname` = " . $search;
        }

		return $this->query($sql);
    }

}
