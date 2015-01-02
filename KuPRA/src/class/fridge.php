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
	
	public static function searchMissing($user, $data = array(), $modifier) {
		$fullFridge = databaseController::getDB()->query("SELECT * FROM saldytuvas WHERE Vartotojas = ?", array($user))->results();
		$missing = array();
		$foundMes = false;
		$foundProd = false;
		$foundQuan = false;
		foreach ($data as $reqProd) {
			foreach($fullFridge as $ownProd) {
				if ($reqProd->Produktas == $ownProd->Produktas) {
					$foundProd = true;
					if (($reqProd->Kiekis*$modifier) <= $ownProd->Kiekis) {
						$foundQuan = true;
						if ($reqProd->Matavimo_vienetas == $ownProd->Matavimo_vienetas) {
							$foundMes = true;
						}
					} else {
						$missingQuan = ($reqProd->Kiekis*$modifier) - $ownProd->Kiekis;
					}
				}
			}
			
			if (!$foundProd) {
				array_push($missing, array($reqProd->Produktas, ($reqProd->Kiekis*$modifier), $reqProd->Matavimo_vienetas));
			} else if ((!$foundQuan) && (!$foundMes)) {
				array_push($missing, array($reqProd->Produktas, $missingQuan, $reqProd->Matavimo_vienetas));
			} else if (!$foundQuan) {
				array_push($missing, array($reqProd->Produktas, $missingQuan, $reqProd->Matavimo_vienetas));
			} else if (!$foundMes) {
				array_push($missing, array($reqProd->Produktas, ($reqProd->Kiekis*$modifier), $reqProd->Matavimo_vienetas));
			}
			$foundMes = false;
			$foundProd = false;
			$foundQuan = false;
		}
		return $missing;
	}
	
	public static function removeProducts($product = array(), $modifier) {
		foreach ($product as $pr) {
			$currentProduct = databaseController::getDB()->query("SELECT * FROM saldytuvas WHERE Produktas = ? AND Matavimo_vienetas = ?", array($pr->Produktas, $pr->Matavimo_vienetas))->results()[0];
			databaseController::getDB()->query("UPDATE saldytuvas SET Kiekis = ? WHERE Produktas = ? AND Matavimo_vienetas = ?", array(($currentProduct->Kiekis - round(($pr->Kiekis*$modifier), 2)), $pr->Produktas, $pr->Matavimo_vienetas));
		}
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
