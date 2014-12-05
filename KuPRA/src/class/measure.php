<?php

class measure {
	
	public $measure = array();
	
	public static function getAllMeasures() {
		$measures = new measure;
		$measuresData = databaseController::getDB()->get("produkto_matavimo_vienetai", array("Produktas", "=", $id))->results();
		return $measures;
	}
	
}

?>