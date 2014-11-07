<meta charset="UTF-8">

<?php
include_once 'measurementUnit.php';
/*
 * Testavimas
 */

$measurementUnits = new measurementUnit(1, "Kilogramai", "kg", "masė");
echo $measurementUnits->getType();
?>