<?php

class product {
	
	public $id;
	public $author;
	public $name;
	public $description;
	public $picture;
	public $measurementUnits = array();
	
	
	public static function getProduct($id) {
		$product = new product;
		$product->setId($id);
		$productData = databaseController::getDB()->get("maisto_produktai", array("id", "=", $id))->results()[0];
		$product->setAuthor($productData->Autorius);
		$product->setName($productData->Pavadinimas);
		$product->setDescription($productData->Aprasymas);
		$product->setPicture($productData->Nuotrauka);
		$measuresData = databaseController::getDB()->get("produkto_matavimo_vienetai", array("Produktas", "=", $id))->results();
		foreach ($measuresData as $measure) {
			$measureName = databaseController::getDB()->get("matavimo_vienetai", array("ID", "=", $measure->Produktas))->results();
			$measureShort = $measureName[0]->Trumpinys;
			$measureInfo = array($measure->Produktas, $measureShort);
			array_push($product->measurementUnits, $measureInfo);
		}
		return $product;
	}
	
	public static function getProductByName($name) {
		$product = new product;
		$product->setName($name);
		$productData = databaseController::getDB()->get("maisto_produktai", array("Pavadinimas", "=", $name))->results()[0];
		$product->setAuthor($productData->Autorius);
		$product->setId($productData->ID);
		$product->setDescription($productData->Aprasymas);
		$product->setPicture($productData->Nuotrauka);
		$measuresData = databaseController::getDB()->get("produkto_matavimo_vienetai", array("Produktas", "=", $product->id))->results();
		foreach ($measuresData as $measure) {
			$measureName = databaseController::getDB()->get("matavimo_vienetai", array("ID", "=", $measure->Produktas))->results();
			$measureShort = $measureName[0]->Trumpinys;
			$measureInfo = array($measure->Produktas, $measureShort);
			array_push($product->measurementUnits, $measureInfo);
		}
		return $product;
	}
	
	public static function checkIfExists($name) {
		$productData = databaseController::getDB()->get("maisto_produktai", array("Pavadinimas", "=", $name))->results();
		return $productData;
	}
	
	public static function sendMinProduct($user, $name) {
		databaseController::getDB()->insert("maisto_produktai", array("Autorius" => $user, "Pavadinimas" => $name));
	}
	
	public static function addToRecepie($recp, $prod, $quan, $meas) {
		databaseController::getDB()->insert("recepto_produktai", array("Receptas" => $recp, "Produktas" => $prod, "Kiekis" => $quan, "Matavimo_vienetas" => $meas));
	}
	
	
	
	public function setId($val) {
		$this->id = $val;
	}
	
	public function setAuthor($val) {
		$this->author = $val;
	}
	
	public function setName($val) {
		$this->name = $val;
	}
	
	public function setDescription($val) {
		$this->description = $val;
	}
	
	public function setPicture($val) {
		$this->picture = $val;
	}
	
	public function setMeasurementUnits($val) {
		$this->measurementUnits = $val;
	}
	
	
	public function getId() {
		return $this->id;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getPicture() {
		return $this->picture;
	}
	
	public function getMeasurementUnits() {
		return $this->mesurementUnits;
	}
	
}

?>