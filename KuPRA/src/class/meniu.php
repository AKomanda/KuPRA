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
		$this->id = $databaseController->getMeniuId($author); //kazkokia funkcija kuri is duomenu bazes traukia id
		/*
		 * grazina integer
		 */
		$this->author = $author;
		/*
		 * grazina array
		 */
		$this->recepies = $databaseController->getMeniuRecepies($author); //kazkokia funckija kuri is domenu bazes traukia meniu
	}

	public function getId() {
		return $this->id;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function getRecepies() {
		return $this->recepies;
	}

}

?>