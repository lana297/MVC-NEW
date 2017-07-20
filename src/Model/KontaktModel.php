<?php
namespace Model;
use Helpers\QueryBuilder;
use Helpers\Db;

class KontaktModel extends AbstractModel
{
	public function getContacts()
	{
		$query = new QueryBuilder();

		$query->setFrom(array('korisnik as k'))
			->setSelect(array('k.ime', 'k.prezime','k.email', 't.naziv'))
			->setWhere(array('k.korisnik_id' =>  "=12"))
			->setJoin('tip_korisnika as t', 't.tip_id=k.tip_id')
			->setOrderby('k.tip_id');

		$sql = $query->getSQL();
		
		var_dump( $sql);
		return $this->db->query($sql);

	}
}
