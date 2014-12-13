<?php
	include_once 'core/init.php';
	$admin = $admin = User::current_user()->isAdmin();
	$errors = array();
	$file_errors = array();
	
	if(isset($_POST['create'])){
		if(empty($_POST['measures'])){
			$errors[] = 'Nepasirinktas joks matavimo vienetas';	
		}
		if(strlen( $_POST['name']) == 0 || strlen($_POST['name']) > 100){
			$errors[] = 'Netinkamas pavadinimo ilgis';
		}elseif(!preg_match("/[a-zA-Z0-9 \pL]/", $_POST['name'])){
			$errors[] = 'Pavadinime vartojami neleistini simboliai';	
		}elseif(databaseController::getDB()->get('maisto_produktai', array('Pavadinimas', '=', $_POST['name']))->count() != 0){
			$errors[] = 'Toks pavadinimas jau egzistuoja!';
		}
		if(empty($errors)){
			databaseController::getDB()->insert('maisto_produktai', array(
				'Autorius' => User::current_user()->id,
				'Pavadinimas' => $_POST['name'],
				'Aprasymas' => $_POST['description']));
			$newId = databaseController::getDB ()->getLast ();
			foreach($_POST['measures'] as $measure){
				databaseController::getDB()->insert('produkto_matavimo_vienetai', array('Produktas' => $newId, 'Matavimo_vienetas' => $measure));	
			}
			$name = false;

			$path = "/uploads/products/" . $newId .'/';
			if(isset($_FILES['photos'])){
				$name = fileUploadController::uplProductFile($_FILES['photos'], array("jpg", "jpeg", "png", "bmp"), 1024*1024*2, "/uploads/products/" . $newId .'/');			
			}
			if( $name != false ){
				databaseController::getDB()->update('maisto_produktai', array('Nuotrauka' => '..' . $path . $name), array('ID', '=', $newId));
			}else{
				$file_errors[] = 'Nepavyko ikelti nuotraukos';
				databaseController::getDB()->update('maisto_produktai', array('Nuotrauka' => '../resources/default/recepie/default.png'), array('ID', '=', $newId));
			}
		}
		
	}
	if(isset($_POST['remove'])){		
		$id = $_POST['removeItem'];
		databaseController::getDB()->delete('maisto_produktai', array('ID', '=', $id));
	}
	if(isset($_POST['edit'])){
		$edit_item = $_POST['editItem'];
		echo "<script type='text/javascript'>$(document).ready(function(){ $('#myModal').modal('show');});</script>";
	}
	
	foreach($errors as $error){
		echo $error;
	}
	
?>
<div class='row'>
	<div class="col-xs-4">
		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Produkto kūrimas</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="post" accept-charset="UTF-8" role="form" enctype="multipart/form-data">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Pavadinimas" name="name" type="text">
			    		</div>
			    		<div class="form-group">
			    			<label for="description">Aprašymas:</label>
							<textarea class="form-control" id="productTA" name="description"></textarea>
			    		</div>
			    		<div class='form-group'>
			    			
			    			<select multiple name = 'measures[]' class="form-control" title = 'Prispauskite "ctrl", kad pasirinkti kelis matavimo vienetus'>
            					<?php
									$measures = Measure::getAllMeasures();
									foreach($measures as $m){
										echo "<option value ='{$m->ID}'>";
										echo $m->Pavadinimas;
										echo "</option>";
									}
            					?>
         					</select>
			    		</div>
			    		<div class = 'form-group'>
			    			<input name="photos[]" type="file" accept="image/*" class='productPhoto' >
			    		</div>
			    		<input name = 'create' class="btn btn-success btn-block" type="submit" value="Sukurti">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
	</div>
	<div class="col-xs-8">
		<div class="listContainer">
			<div class="table-responsive">
				<table class="table table-boarded table-stripped">
					<thead>
						<th></th>
						<th>Pavadinimas</th>
						<th>Aprašymas</th>
						<th>Matavimas</th>
						<?php if($admin){ echo "<th></th>";} ?>
					</thead>
					<tbody>
					
						<?php 
						$products = Product::all();
						foreach($products as $productInfo){
							$product = Product::getProduct($productInfo->ID);
						?>
						<tr class="listItemContainer">
							<td class="produktoNuotraukosStulpelis"><div class="produktoNuotrauka"><img src=<?php echo $product->picture; ?>></div></td>
							<td class="produktoPavadinimoStulpelis">
								<h4><?php echo $product->name; ?></h4>
								<a href=""><?php echo User::getUser($product->author)->nick; ?></a>
							</td>
							<td class="produktoAprStulpelis"><t><?php echo $product->description ?></t></td>
							<td class = "produktoMatStulpelis">
								<div class="dropdown">
								<a data-target="#" data-toggle="dropdown" class="dropdown-toggle" href="#">
								Matavimas
		                        <b class="caret"></b>
		                        </a>
								<ul class="dropdown-menu">
									<?php 
										foreach($product->measurementUnits as $unit){
										echo "<li role='presentation' class='dropdown-header'>{$unit[2]}</li>";
										}
									?>
								</ul>
								</div>
							</td>
							<?php if($admin){ ?>
							<td>
								<?php if(!Product::isUsed($product->id)){?>
								<form name="form" action="" method="post">
									<input type = 'hidden' name = 'editItem', value = <?php echo $product->id;?>>
									<button name = "edit"  type="submit" class="btn btn-success" >
										<span class=" glyphicon glyphicon-edit">
										</span>
									</button>
								</form>
								<form name="form" action="" method="post">
									<input type = 'hidden' name = 'removeItem', value = <?php echo $product->id;?>>
									<button name = 'remove' type="submit" class="btn btn-danger" >
										<span class="glyphicon glyphicon-remove">
										</span>
									</button>
								</form>
								<?php }else{echo "<t>Panaudotas</t>";}?>
							</td>
							<?php }?>
						</tr>
						<?php }?>			
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div id ="myModal" class="modal fade">
	<?php 
		if($edit_item != 0){
			$p = Product::getProduct($edit_item);
		}?>
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Saldytuvo turinio redagavimas</h4>
        		<form method="post" accept-charset="UTF-8" class="form-inline" role="form">
      				<div class="modal-body">
      				<fieldset>
      					<div class="form-group">
      						<textarea class="form-control" id="productTA" rows='2' name="description" placeholder="Aprašymas"><?php echo $p->description; ?></textarea>
      						<select multiple class="form-control" size='3' name ="vnt">
      						<?php
									$measures = Measure::getAllMeasures();
									foreach($measures as $m){
										if(array_key_exists($m->ID, $p->measurementUnits)){
											echo"<option value ='{$m->ID}' selected='selected'>";
										}else{
											echo "<option value ='{$m->ID}'>";
										}
										echo $m->Pavadinimas;
										echo "</option>";
									}
            					?>
      						</select>
      						<input name="photos[]" type="file" accept="image/*" >
      						<input type='hidden' name='item' value='<?php if($edit_item != 0){echo $edit_item;} ?>'>
      					</div>
      				</fieldset>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        				<button type="submit" name="complete" class="btn btn-primary">Redaguoti</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>

</div>
</div>
