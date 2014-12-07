<?php

class fridge {
	
	public $id;
	public $products = array();
	
	public static function getFridge($user) {
		$fridge = new fridge;
		$fridge->setId($user);
		$fridgeData = databaseController::getDB()->get("saldytuvas", array("Vartotojas", "=", $user))->results();
		
		foreach($fridgeData as $product) {
			$pavadinimas = databaseController::getDB()->query("SELECT Pavadinimas FROM maisto_produktai WHERE id = ?", array($product->Produktas))->results()[0];
			$mat = databaseController::getDB()->query("SELECT Pavadinimas FROM matavimo_vienetai WHERE id = ?", array($product->Matavimo_vienetas))->results()[0];
			$prod = array ($pavadinimas->Pavadinimas, $product->Kiekis, $mat->Pavadinimas);
			array_push($fridge->products, $prod);
		}
		return $fridge;
	}
	
	public function setId($val) {
		$this->id = $val;
	}
	
	public function setProducts($val) {
		$this->products = $val;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getProducts() {
		return $this->products;
	}
}

?>
