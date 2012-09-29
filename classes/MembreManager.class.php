<?php
/**
* MembreManager
*/
abstract class MembreManager {
	protected $dao;

	public function __construct($dao) {
		$this->dao = $dao;
	}

	abstract function add(Membre $membre);
	abstract function update(Membre $membre);
	abstract function get($info); //Pseudo or id
	abstract function delete(Membre $membre);
	abstract function getList();
	abstract function exists($info); //Pseudo or id
}