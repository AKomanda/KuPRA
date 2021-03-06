<?php

include_once 'core/init.php';
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
//		$meniuData = databaseController::getDB()->get("valgiarastis", array("Vartotojas", "=", $author))->results();
		$meniuData = databaseController::getDB()->query("SELECT * FROM valgiarastis WHERE Vartotojas = ? ORDER BY Gaminimo_data DESC", array($author))->results();
		foreach($meniuData as $receptas) {
			$receptoNuotraukos = databaseController::getDB()->query("SELECT Nuotrauka FROM receptu_nuotraukos WHERE receptas = ?", array($receptas->Receptas))->results();
			$receptas->Nuotraukos = $receptoNuotraukos;
		}
	
		foreach($meniuData as $receptas) {
			$receptas->MeniuID = $receptas->ID;
			$receptas->ID = $receptas->Receptas;
			
		}
		
		foreach($meniuData as $receptas) {
			$recepieName = databaseController::getDB()->query("SELECT Pavadinimas, Aprasymas FROM receptai WHERE id = ?", array($receptas->Receptas))->results()[0];
			$receptas->Receptas = $recepieName->Pavadinimas;
			$receptas->Aprasymas = $recepieName->Aprasymas;
		}

		$meniu->recepies = $meniuData;
		
		
		return $meniu;
	}
	
	
	public static function addNewRecepie($user, $recepie, $date, $portion) {
		databaseController::getDB()->insert("valgiarastis", array (
		"Vartotojas" => $user,
		"Gaminimo_data" => $date,
		"Porciju_skaicius" => $portion,
		"Receptas" => $recepie
		));
	}
	
	public static function getPortionById($id) {
		return databaseController::getDB()->query("SELECT Porciju_skaicius FROM valgiarastis WHERE ID = ?", array($id))->results()[0]->Porciju_skaicius;
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