<?php

include_once "databaseController.php";
class meniu
{
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
	
	public static function getMeniu($author){
		$meniu = new meniu;
		$meniu->setAuthor($author);
		$meniuData = databaseController::getDB()->get("valgiarastis", array("Vartotojas", "=", $author))->results();
		
		
		foreach($meniuData as $receptas) {
			$receptoNuotraukos = databaseController::getDB()->query("SELECT Nuotrauka FROM receptu_nuotraukos WHERE receptas = ?", array($receptas->Receptas))->results();
			$receptas->Nuotraukos = $receptoNuotraukos;
		}
	
		foreach($meniuData as $receptas) {
			$receptas->ID = $receptas->Receptas;
		}
		
		foreach($meniuData as $receptas) {
			$recepieName = databaseController::getDB()->query("SELECT Pavadinimas FROM receptai WHERE id = ?", array($receptas->Receptas))->results()[0]->Pavadinimas;
			$receptas->Receptas = $recepieName;
		}

		$meniu->recepies = $meniuData;
		
		
		return $meniu;
	}
	
	
	//get functions



	public function getAuthor() {
		return $this->author;
	}

	public function getRecepies() {
		return $this->recepies;
	}
	
	//set functions
	
	
	public function setAuthor($val) {
		$this->author = $val;
	}
	
	public function setRecepies($val) {
		$this->recepies = $val;
	}

}

?>