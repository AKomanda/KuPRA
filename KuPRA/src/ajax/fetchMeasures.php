<?php
  include_once '../class/databaseController.php';
if ($_POST) {
	$q = $_POST ['search'];
	$qb = $q;
	$availableMeas = array();
	$auth = databaseController::getDB ()->get ( "maisto_produktai", array (
			"Pavadinimas",
			"=",
			$qb 
	) )->results ();
	if (!empty($auth)) {
		$allMeas = databaseController::getDB()->get("produkto_matavimo_vienetai", array("Produktas", "=", $auth[0]->ID))->results();
		foreach ($allMeas as $a) {
			$vnt = databaseController::getDB()->get("matavimo_vienetai", array("ID", "=", $a->Matavimo_vienetas))->results()[0];
			array_push($availableMeas, $vnt->Pavadinimas);
		}
	} else {
		$allMeas = databaseController::getDB()->query("SELECT * FROM matavimo_vienetai", array())->results();
		foreach ($allMeas as $a) {
			$vnt = databaseController::getDB()->get("matavimo_vienetai", array("ID", "=", $a->Matavimo_vienetas))->results()[0];
			array_push($availableMeas, $vnt->Pavadinimas);
		}
	}
	
	foreach ( $availableMeas as $words ) {
		echo "<option>" . $words . "</option>";
	}
}
?>