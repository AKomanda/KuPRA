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
	public $recepies = array();

	


	public function __construct() {
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

?>