<?php

include_once "databaseController.php";
class meniu
{
	/*
	 * meniu id
	 */
	private $id;
	/* 
	 * meniu autorius
	 */
	public $author;
	/*
	 * receptu masyvas
	 */
	public $recepies;
	/*
	 * duomenu bazes valdytojas
	 */
	private $databaseController = null;
	


	public function __construct($author) {
		$databaseController = new databaseController();
		/*
		 * grazina integer
		 */
		$this->setId($databaseController->getMeniuId($author)); //kazkokia funkcija kuri is duomenu bazes traukia id
		/*
		 * grazina integer
		 */
		$this->setAuthor($author);
		/*
		 * grazina array
		 */
		$this->setRecepies($databaseController->getMeniuRecepies($author)); //kazkokia funckija kuri is domenu bazes traukia meniu
	}
	
	//get functions

	public function getId() {
		return $this->id;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function getRecepies() {
		return $this->recepies;
	}
	
	//set functions
	
	public function setId($val) {
		$this->id = $val;
	}
	
	public function setAuthor($val) {
		$this->author = $val;
	}
	
	public function setRecepies($val) {
		$this->recepies = $val;
	}

}
/*
 * usage
 * $menu = new meniu('1');
 * echo $menu->getRecepies()[0][0];
 */

?>