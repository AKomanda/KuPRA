<?php
include_once './class/recepie.php';
include_once './class/measure.php';
include_once './class/product.php';
include_once './class/databaseController.php';
include_once './class/fileUploadController.php';

$measureUnits = measure::getAllMeasures ();

echo "DEMESIO: reikes pakeisti @ newRecepieDisplay.php";

if ($_POST) {

	if ((isset ( $_POST ['recipeName'] )) && (isset ( $_POST ['portions'] )) && (isset ( $_POST ['time'] )) && (isset ( $_POST ['description'] ))) {
		if ((isset ( $_POST ['ingredient'] )) && (isset ( $_POST ['measurement'] )) && (isset ( $_POST ['quantity'] ))) {
			
			$recName = $_POST ['recipeName'];
			$portions = $_POST ['portions'];
			$time = $_POST ['time'];
			$ingredients = $_POST ['ingredient'];
			$measr = $_POST ['measurement'];
			$quantity = $_POST ['quantity'];
			$descrp = $_POST ['description'];
			
			$error = false;
			
			if (!ctype_digit($portions) || !ctype_digit($time)) {
				$error = true;
			}
			
			for($i = 0; $i < sizeOf ( $ingredients ); $i ++) {
				if ((strlen ( $ingredients [$i] ) == 0) || (!ctype_digit ( $quantity [$i] ))) {
					$error = true;
				}
			}
			
			if (! $error) {				
				if (isset ( $_POST ['privacy'] )) {
					$visibility = 0;
				} else {
					$visibility = 1;
				}
				
				recepie::sendRecepie ( "1", $recName, $portions, $time, $descrp, $visibility );
				$newRecpId = databaseController::getDB ()->getLast ();
				
				for($i = 0; $i < sizeOf ( $ingredients ); $i ++) {
					$ingr = product::checkIfExists($ingredients[$i]);
					$meaId = measure::getMeasureByName ( $measr [$i] )->id;
					if (empty($ingr)) {
						product::sendMinProduct ( "1", $ingredients [$i] );
						$pr = databaseController::getDB ()->getLast ();
						measure::sendProductMeasure ( $pr, $meaId );
					} else {
						$pr = product::getProductByName ( $ingredients [$i] )->id;
					}
					product::addToRecepie($newRecpId, $pr, $quantity[$i], $meaId);
				}
				
				if(isset($_FILES['photo'])) {
					fileUploadController::uplRecepieFile($newRecpId, $_FILES['photo'], array("jpg", "jpeg", "png", "bmp"), 1024*1024*2,  "/uploads/" . "login/" . $newRecpId . "/");
				}
				
				header('location: recepie.php?id=' . $newRecpId);
				
			} 


		}
	}
}
?>

	<div class="title">
		<h1>Pridėti receptą</h1>
	</div>
	<div class="recipesForm">
		<form method="post" class="createForm" enctype="multipart/form-data">
			<div class="leftSide">
				<fieldset class="info">
					<label>Pavadinimas</label> <input type="text" name="recipeName" />
					<div class="clear"></div>
					<label>Porcijų skaičius</label> <input class="short" type="text"
						name="portions" />
					<div class="clear"></div>
					<label>Gaminimo laikas</label> <input class="short" type="text"
						name="time" />&nbsp; min.
				</fieldset>
				<fieldset class="ingredients">
					<label>Produktai</label>
					<table>
						<thead>
							<tr>
								<td>Produktas</td>
								<td>Matavimo vienetas</td>
								<td>Kiekis</td>
							</tr>
						</thead>
						<tbody class="productsContainer">
							<tr class="row">
								<td><input type="text" name="ingredient[]" id="searchid"
									class="search">
									<div id="result"></div></td>
								<td><select name="measurement[]">
										<?php
										foreach ( $measureUnits as $mu ) {
											echo "<option>" . $mu->Pavadinimas . "</option>";
										}
										?>
								</select></td>
								<td><input class="small" type="text" name="quantity[]" /></td>
								<td><input type="button" class="add" name="add" value="+" /></td>
							</tr>
						</tbody>
					</table>

				</fieldset>
				<fieldset class="description">
					<label>Gaminimo aprašmas</label>
					<textarea name="description" rows="5" cols="45"></textarea>
				</fieldset>
				<fieldset class="photos">
					<label>Nuotraukos</label>
					<span>Iki 6 nuotraukų. Maksimalus dydis: 2MB.</span>
					<table>
						<tr>
							<td><input name="photo[]" type="file" accept="image/*" /></td>
						</tr>
						<tr>
							<td><input name="photo[]" type="file" accept="image/*" /></td>
						</tr>
					</table>	
				</fieldset>
				<fieldset style="float: right;" class="confirm">
					Privatus? &nbsp;<input name="privacy" type="checkbox" /> <input
						type="submit" value="Pridėti" />
				</fieldset>
			</div>
			<div class="rightSide">
				<fieldset class="type"></fieldset>
			</div>
		</form>
	</div>
