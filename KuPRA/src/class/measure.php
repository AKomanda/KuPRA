<?php
include_once "databaseController.php";

class measure {
	
	public $id;
	public $author;
	public $name;
	public $short;
	
	
// 	public static function getMeasureById($id) {
// 		$measures = new measure;
// 		$measuresData = databaseController::getDB()->get("matavimo_vienetai", array("ID", "=", $id))->results()[0];
// 		return $measures;
// 	}

	public static function getAllMeasures() {
		$measures = databaseController::getDB()->query("Select * from matavimo_vienetai")->results();
		return $measures;
	}
	
	public static function getMeasureByName($name) {
		$measure = new measure;
		$measuresData = databaseController::getDB()->get("matavimo_vienetai", array("Pavadinimas", "=", $name))->results()[0];
		$measure->id = $measuresData->ID;
		$measure->author = $measuresData->Autorius;
		$measure->short = $measuresData->Trumpinys;
		$measure->name = $measuresData->Pavadinimas;
		return $measure;
	}
	
	public static function sendProductMeasure($prod, $mea) {
		databaseController::getDB()->insert("produkto_matavimo_vienetai", array("Produktas" => $prod, "Matavimo_vienetas" => $mea));
	}
	
}

?>