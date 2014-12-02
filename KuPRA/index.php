<?php
echo "Entities display";

include_once "src/class/databaseController.php";
include_once "src/class/recepie.php";
include_once "src/class/meniu.php";
include_once "src/class/user.php";
include_once "src/class/product.php";

$user = databaseController::getDB()->get("recepto_tipai", array('tipas', '=', 2));
recepie::getRecepie(1);

var_dump(recepie::getRecepie(1));
var_dump(meniu::getMeniu(1));
var_dump(user::getUser(1));
var_dump(product::getProduct(2));
?>

