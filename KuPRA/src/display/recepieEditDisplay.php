<?php

include_once './core/init.php';

$errorss = array();

$receptas = recepie::getRecepie($_GET['id']);

if($receptas != false){
	if($receptas->authorId != User::current_user()->id && !User::current_user()->isAdmin()){
		$errorss[] = 'Jus neturite teisės redaguoti šio recepto';
	}	
}else{
	
	$errorss[] = 'Toks receptas nerastas';
}

$regex_with_space = "/[a-zA-Z0-9 \pL]/";

$measureUnits = measure::getAllMeasures ();

$errors = array();
	if (isset($_POST['update'])) {
			$recName = $_POST ['recipeName'];
			$portions = $_POST ['portions'];
			$time = $_POST ['time'];
			$ingredients = $_POST ['ingredient'];
			$measr = $_POST ['measurement'];
			$quantity = $_POST ['quantity'];
			$descrp = $_POST ['description'];
		
			
			
			if (!ctype_digit($time) || ctype_digit($time) <= 0) {
				$errors[] = 'Gaminimo laikas nurodytas neteisingai';
			}
			
			if(sizeof($ingredients) != 0){
				for($i = 0; $i < sizeOf ( $ingredients ); $i ++) {
					if (strlen ( $ingredients [$i] ) == 0 || $quantity[$i] <= 0 || $measr[$i] == 0) {
						echo "{$ingredients[$i]} {$quantity[$i]}{$measr[$i]}<br>";
						echo ctype_digit($quantity[$i]);
						$errors[] = 'Klaida nurodant produktus.';
						break;
					}
				}	
			}else{
				$errors[] = 'Nenurodytas nei vienas produktas';
			}
			
			
			if(!preg_match($regex_with_space, $recName)){
				$errors[] = 'Pavadinime naudokite tik raides skaičius ir tarpus';
			}
			
			if (empty($errors)) {				
				if (isset ( $_POST ['privacy'] )) {
					$visibility = 0;
				} else {
					$visibility = 1;
				}
				
				recepie::updateRecepie ($_GET['id'], $receptas->authorId, $recName, $portions, $time, $descrp, $visibility );
				$newRecpId = databaseController::getDB ()->getLast ();
				databaseController::getDB()->query("DELETE FROM recepto_produktai WHERE Receptas = ?", array($_GET['id']));
				
				for($i = 0; $i < sizeOf ( $ingredients ); $i ++) {
					$p = product::getProductIdByName($ingredients[$i]);
					echo "{$newRecpId} {$p} {$quantity[$i]} {$measr[$i]}";
					product::addToRecepie($_GET['id'], $p, $quantity[$i], $measr[$i]);
				}
				
				if(isset($_FILES['photo'])) {
					databaseController::getDB()->query("DELETE FROM receptu_nuotraukos WHERE receptas = ?", array($_GET['id']));
					fileUploadController::uplRecepieFile($_GET['id'], $_FILES['photo'], array("jpg", "jpeg", "png", "bmp"), 1024*1024*2,  "/uploads/" . user::current_user()->login . "/" . $newRecpId . "/");
				}
				
				header('location: recepie.php?id=' . $_GET['id']);
				
			} 


		}

?>

	<div class="title">
		<h3>Recepto redagavimas</h3>
		<?php
			$count = 1;
			foreach ( $errors as $error ) {
				echo "<font size='3' color='red'>{$count}.{$error}</font><br>";
				$count ++;
			}
		?>
	</div>
	<?php if(!empty($errorss)){
		$count = 1;
		foreach ( $errorss as $error ) {
			echo "<font size='3' color='red'>{$count}.{$error}</font><br>";
			$count ++;
		}	
	}else{?>
	<div class="recipesForm">
		<form method="post" class="form-horizontal" enctype="multipart/form-data">
			<div class = 'form-group'>
				<label>Pavadinimas</label>
				<div class = 'col-sm-6'>
					<input type="text" name="recipeName" class = "form-control" value="<?php echo $receptas->name ; ?>"/>
				</div>
			</div>
			<div class = 'form-group'>
				<label>Porcijų skaičius</label>
				<div class ='col-sm-2'>
					<input class = "form-control" type="text" name="portions" value=" <?php echo $receptas->portionCount ;?>" />
				</div>
			</div>
			<div class = 'form-group'>
				<label>Gaminimo laikas (min.)</label>
				<div class ='col-sm-2'>
					<input class = "form-control" type="text"name="time" value="<?php  echo $receptas->timeToMake; ?>" />
				</div>
			</div>
			<div class = 'form-group'>
				<fieldset class="ingredients">
					<label>Produktai</label>
					<div class = 'col-sm-6'>
					<table>
						<thead>
							<tr>
								<th></th>
								<th>Produktas</th>
								<th>Matavimo vienetas</th>
								<th>Kiekis</th>
								<th><input type="button" class="add btn btn-success btn-sm" name="add" value="+" /></th>
							</tr>
						</thead>
						<tbody class="productsContainer">
						<?php foreach ($receptas->products as $pr) {?>
							<tr class="row product">
								<td style = 'min-width:200px;'>
									<input type="text" name="ingredient[]" id="searchid" value="<?php echo $pr->Produktas; ?>" class="form-control" autocomplete = 'off'>
									<div id="result" class = 'result'></div></td>
								<td style = 'min-width:175px;'>
									<select name="measurement[]" class="form-control" id = 'mat'>	
										<option value = '0'>Matavimo vienetas</option>
									</select>
								</td>
								<td style = 'min-width:100px;'>	
									<input type="number" min="0.01" value="<?php echo $pr->Kiekis; ?>" step="0.01" name ='quantity[]' class="form-control">
								</td>
								<td>
									<input type="button"  class="del btn btn-danger btn-sm" name="del" value="-" />
								</td>
							</tr>

						<?php } ?>
						</tbody>
					</table>
					</div>
				</fieldset>
				</div>
				<div class = 'form-group'>
					<label>Gaminimo aprašmas</label>
					<textarea class = 'form-control' name="description" rows="3" cols="5" style='width:40%'><?php echo $receptas->description; ?></textarea>
				</div>
				<div class = 'form-group'>
					<label>Nuotraukos</label>
					<div class = 'col-sm-8'>
					<table>
						<thead>
							<td >Iki 6 nuotraukų. Maksimalus dydis: 2MB.</td>
						</thead>
						<tbody>
							<tr>
								<td style="min-width:300px;"><input name="photo[]" type="file" accept="image/*" multiple /></td>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
				<fieldset class="confirm">
					Privatus? &nbsp;<input name="privacy" type="checkbox" />
					<input type="submit" value="Atnaujinti" name = 'update'/>
				</fieldset>
			
		</form>
	</div>
	<?php }?>
