<?php
	include_once 'core/init.php';
	$perPage = 10;
	if(isset($_GET['page'])){
		if($_GET['page'] > 1){
			$page = $_GET['page'];
			$offset = ($page - 1) * $perPage;
		}else{
			$page = 1;
			$offset = 0;
		}
	}else{
		$page = 1;
		$offset = 0;
	}
	$admin = $admin = user::current_user()->isAdmin();
	$errors = array();
	$file_errors = array();
	$edit_item = 0;
	
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
				'Autorius' => user::current_user()->id,
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
		if(file_exists($_POST['picpath']) && strpos($_POST['picpath'], '../uploads') === 0){
			unlink($_POST['picpath']);
			rmdir("../uploads/products/{$id}");
		}
		databaseController::getDB()->delete('maisto_produktai', array('ID', '=', $id));
	}
	if(isset($_POST['complete'])){
		if(empty($_POST['vnt'])){
			$errors[] = 'Nepasirinktas joks matavimo vienetas';
		}
		if(empty($errors)){
			databaseController::getDB()->delete('produkto_matavimo_vienetai', array('Produktas', '=', $_POST['item']));
			foreach($_POST['vnt'] as $measure){
				databaseController::getDB()->insert('produkto_matavimo_vienetai', array('Produktas' => $_POST['item'], 'Matavimo_vienetas' => $measure));
			}
			if(isset($_FILES['updphotos'])){
				echo ':)';
				$name = fileUploadController::uplProductFile($_FILES['updphotos'], array("jpg", "jpeg", "png", "bmp"), 1024*1024*2, "/uploads/products/" . $_POST['item'] .'/');
				databaseController::getDB()->update('maisto_produktai', array('Aprasymas' => $_POST['description']), array('ID', '=', $_POST['item']));
			}else{
				databaseController::getDB()->update('maisto_produktai', array('Aprasymas' => $_POST['description']), array('ID', '=', $_POST['item']));
			}
		}
	}
	

	$allProducts = product::all();
	$recordCount = count($allProducts);
	if($recordCount > $offset){
		$products = array_slice($allProducts, $offset, $perPage);
	}else{
		$products = array();
	}
	
	foreach($errors as $error){
		echo $error;
	}
	
?>

<script type='text/javascript'>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
		$('#myModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var product = button.data('product');
			var description = button.data('description');
			var modal = $(this);
			modal.find('.modal-body #product').val(product);
			modal.find('.modal-body #description').val(description);
		});
	});
</script>
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
			    			<label for="description">Matavimo vienetai:</label>
			    			<select multiple name = 'measures[]' class="form-control" title = 'Prispauskite "ctrl", kad pasirinkti kelis matavimo vienetus'>
            					<?php
									$measures = measure::getAllMeasures();
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
						foreach($products as $productInfo){
							$product = Product::getProduct($productInfo->ID);
						?>
						<tr class="listItemContainer">
							<td class="produktoNuotraukosStulpelis"><div class="produktoNuotrauka"><img src=<?php echo $product->picture; ?>></div></td>
							<td class="produktoPavadinimoStulpelis">
								<h4><?php echo $product->name; ?></h4>
								<a href="user.php?id=<?php echo User::getUser($product->author)->id; ?>"><?php echo User::getUser($product->author)->nick; ?></a>
							</td>
							<?php if(strlen($product->description) > 40){ ?>
							<td class="produktoAprStulpelis" data-toggle="tooltip" data-placement="left" title="<?php echo $product->description; ?>" data-container="body"><t><?php echo substr($product->description, 0 , 37) . '...' ?></t></td>
							<?php }else{?>
							<td class="produktoAprStulpelis"><t><?php echo $product->description?></t></td>
							<?php }?>
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
								
									<input type = 'hidden' name = 'editItem', value = <?php echo $product->id;?>>
									<button name = "edit"  type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" data-description = '<?php echo $product->description ?>' data-product = <?php echo $product->id?>>
										<span class=" glyphicon glyphicon-edit">
										</span>
									</button>
								
								<form name="form" action="" method="post">
									<input type = 'hidden' name = 'removeItem', value = <?php echo $product->id;?>>
									<input type = 'hidden', name = "picpath", value = <?php echo $product->picture;?>>
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
			
			<div class = 'row'>
			<div class = 'col-xs-12'>
				<p style="text-align:center;">
					<?php if($offset > 0){
						$prevPage = $page - 1;
						echo "<a href = 'products.php?page={$prevPage}'><span class='glyphicon glyphicon-arrow-left'></a>";
					}
					if($offset > 0 || $recordCount > $offset + $perPage){
						echo $page;
					}
					
					if($recordCount > $offset + $perPage){
						$secondPage = $page +1;
						echo "<a href = 'products.php?page={$secondPage}'><span class='glyphicon glyphicon-arrow-right'></a>"; 
					}
					?>
				</p>
			</div>
		</div>
		</div>
	</div>
	<div id ="myModal" class="modal fade">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Saldytuvo turinio redagavimas</h4>
        		<form method="post" accept-charset="UTF-8" class="form-inline" role="form" enctype="multipart/form-data">
      				<div class="modal-body">
      				<fieldset>
      					<div class="form-group">
      						<textarea class="form-control" rows='2' name="description" placeholder="Aprašymas" id='description'></textarea>
      						<select multiple class="form-control" size='3' name ="vnt[]">
      						<?php
      									$measures = Measure::getAllMeasures();
      									foreach($measures as $m){
      										echo "<option value ='{$m->ID}'>";
      										echo $m->Pavadinimas;
      										echo "</option>";
      										
      								}
									
            					?>
      						</select>
      						<input name="updphotos[]" type="file" accept="image/*" >
      						<input type='hidden' name='item' id ='product'>
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
