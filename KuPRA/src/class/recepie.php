<?php
include_once "class/databaseController.php";
class recepie {
	private $id;
	public $author;
	public $name;
	public $score;
	public $scores = array();
	public $type = array();
	public $portionCount;
	public $timeToMake;
	public $products;
	public $description;
	public $photos = array();
	public $visibility;
	
	
	public function __construct() {
		$products = array(array("Pienas", "1"), array("Miltai", "2"));
		$this->setProducts($products);
	}
	
	public static function getRecepie($id){
		$recepie = new recepie;
		$recepie->setID($id);
		$recData = databaseController::getDB()->get("receptai", array("id", "=", $id))->results()[0];
		$auth = databaseController::getDB()->query("SELECT slapyvardis from vartotojas WHERE id = ?", array($recData->Autorius));
		$recepie->setAuthor($auth->results()[0]->slapyvardis);
		$recepie->setName($recData->Pavadinimas);
		$recepie->setPortionCount($recData->Porciju_skaicius);
		$recepie->setTimeToMake($recData->Gamybos_trukme);
		$recepie->setDescription($recData->Aprasymas);
		$recepie->setVisibility($recData->Viesumas);		
		$recScrs = databaseController::getDB()->get("vertinimai", array("receptas", "=", $id))->results();
		foreach($recScrs as $result){
			$u = databaseController::getDB()->query("SELECT slapyvardis from vartotojas WHERE id = ?", array($result->Vertintojas))->results()[0]->slapyvardis;
			$recepie->scores[$u] = $result->Vertinimas;
		}
		$recepie->mean();
		$recTypes = databaseController::getDB()->get("recepto_tipai", array("receptas", "=", $id))->results();
		foreach($recTypes as $type){
			$typeName = databaseController::getDB()->query("SELECT Pavadinimas FROM tipas WHERE id = ?", array($type->Tipas))->results()[0]->Pavadinimas;
			array_push($recepie->type, $typeName);
		}
		$recPictures = databaseController::getDB()->get("receptu_nuotraukos", array("receptas", "=", $id))->results();
		foreach($recPictures as $picture){
			array_push($recepie->photos, $picture->Nuotrauka);
		}
		return $recepie;
	}
	
	private function mean(){
		$count = count($this->scores);
		$sum = array_sum($this->scores);
	    $this->score = $sum/$count;
	}
	
	// get functions
	public function getId() {
		return $this->id;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getScore() {
		return $this->score;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getPortionCount() {
		return $this->portionCount;
	}
	
	public function getTimeToMake() {
		return $this->timeToMake;
	}
	
	public function getProducts() {
		return $this->products;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getPhotos() {
		return $this->photos;
	}
	
	public function getVisibility() {
		return $this->visibility;
	}

	//set functions
	
	public function setId($val) {
		$this->id = $val;
	}
	
	public function setAuthor($val) {
		$this->author = $val;
	}
	
	public function setName($val) {
		$this->name = $val;
	}
	
	public function setScore($val) {
		$this->score = $val;
	}
	
	public function setType($val) {
		$this->type = $val;
	}
	
	public function setPortionCount($val) {
		$this->portionCount = $val;
	}
	
	public function setTimeToMake($val) {
		$this->timeToMake = $val;
	}
	
	public function setProducts($val) {
		$this->products = $val;
	}
	
	public function setDescription($val) {
		$this->description = $val;
	}
	
	public function setPhotos($val) {
		$this->photos = $val;
	}
	
	public function setVisibility($val) {
		$this->visibility = $val;
	}
	
	
}

?>