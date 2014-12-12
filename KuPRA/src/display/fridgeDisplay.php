<?php
	include_once 'core/init.php';
	#$id = $_GET ['id'];
	$errors = array();
	$found_products = array();
	
	function add($p){
		if(!array_key_exists($p['id'], User::current_user()->fridge)){
			User::current_user()->fridge[$p['id']] = array(
					'product' => Product::getProduct($p['id']),
					'amount' => 1,
					'mesure' => 0
			);
		}
		
	}
	
	if (!empty($_POST)) {
		if(isset($_POST['search'])){
			$input = $_POST['search'];
			$validator = new Validation();
			$validator->productSearchValidation($input);
			$errors = $validator->getErrors();
			if(empty($errors)){
				$rez = '%' . $_POST['search'] . '%';
				$a = databaseController::getDB()->get('maisto_produktai', array('Pavadinimas', 'like',$rez ));			
				foreach($a->results() as $prod){
					$mat = databaseController::getDB()->get('produkto_matavimo_vienetai', array('Produktas', '=', $prod->ID))->results();
					$vienetai = array();
					foreach($mat as $m){
						$vienetai[] = $m;
					}
					$found_products[$prod->ID] = Product::getProduct($prod->ID);
				}
			}
		}
		if(isset($_POST['product'])){
			if($_POST['amount'] > 0){
				$data = databaseController::getDB()->query("SELECT * FROM saldytuvas WHERE Vartotojas = ? AND Produktas = ? AND Matavimo_vienetas = ?", array(User::current_user()->id, $_POST['product'], $_POST['vnt']));
				#print_r($data);
				if($data->count() > 0){
					$d = $data->results()[0];
					$amount = $d->Kiekis + $_POST['amount'];
					databaseController::getDB()->update('saldytuvas', array('Kiekis' => $amount), array('ID', '=', $d->ID));
				}else{
				databaseController::getDB()->insert('saldytuvas', array(
					'Vartotojas' => User::current_user()->id,
					'Produktas' => $_POST['product'],
					'Kiekis' => $_POST['amount'],
					'Matavimo_vienetas' => $_POST['vnt']
					));
				}
			}
			
		}if(isset($_POST['removeItem'])){
			#echo $_POST['removeItem'];
			databaseController::getDB()->delete('saldytuvas', array('ID', '=', $_POST['removeItem']));
		}
	}
	$products = User::current_user()->getFridgeContent();
?>
<div class="row">
<div class="col-xs-6">
	<div class="fridgeSearchContainer">
		<?php $count = 1;
			foreach($errors as $error){
				echo "<font size='2' color='red'>{$count}.{$error}</font><br>";
  				$count +=1;
			}
		?>
		<form name="form" action="" method="post">
	  	<div class="input-group">
 			 <input type="text" name="search" class="form-control" placeholder="Produktų paieška">
 			 <span class="input-group-btn">
        		<button type="submit" class="btn btn-success go inline"><span class="glyphicon glyphicon-search"></span></button> 
      		 </span>  
		</div>
		</form>
		<?php if(!empty($found_products)){?>
		<table class="table table-boarded table-stripped">
			<tbody>
				<?php foreach($found_products as $product){?>
				<tr class="listItemContainer" >
					<td class="produktoPaieskosNuotraukosStulpelis">
						<div class="produktoPaieskosNuotrauka">
							<img src=<?php echo $product->picture; ?>>
						</div>
					</td>
					<form name='form' action='' method='post'>
					<td class="produktoPaieskosPavadinimoStulpelis"><?php echo $product->name; ?></td>
					<td class = "produktoKiekioStulpelis"><input type="number" step="0.01" name ='amount' class="form-control"></td>
					<td class="">
						<select class="form-control" name = 'vnt'>
							<?php 
							//	$name = databaseController::getDB()->get('matavimo_vienetai', array('ID', '=', $vnt->Matavimo_vienetas))->results()[0]->Pavadinimas;							
								foreach($product->measurementUnits as $key => $vnt){
									echo "<option value = {$key}>";
									echo $vnt[2];
									echo '</option>';
								}
							?>
						</select>
					</td>
					<td>
						<input type = 'hidden' name = 'product', value = '<?php echo $product->id ?>'>
						<button  type="submit" class="btn btn-success" >
							<span class=" glyphicon glyphicon-plus-sign">
							</span>
						</button>	
					</td>
					</form>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<?php }?>
	</div>
</div>
<div class="col-xs-6">
	<div class="listContainer">
		<div class="table-responsive">
			<table class="table table-boarded table-stripped">
				<thead>
					<th></th>
					<th>Pavadinimas</th>
					<th>Kiekis</th>
					<th>Matavimo vienetas</th>
					<th></th>
				</thead>
				<tbody>
					<?php foreach($products as $item){ ?>
					<tr class="listItemContainer">
						<td class="produktoNuotraukosStulpelis"><div class="produktoNuotrauka"><img src=<?php echo $item['product']->picture; ?>></div></td>
						<td class="produktoPavadinimoStulpelis"><h4><?php echo $item['product']->name; ?></h4></td>
						<td class = "produktoKiekioStulpelis"><?php echo $item['amount'] ?></td>
						<td class="matavimoVienetoStulpelis">
							<?php echo $item['product']->measurementUnits[$item['mesure']][2] ?>					
						</td>
						<td>
							<form name="form" action="" method="post">
								<input type = 'hidden' name = 'editItem', value = <?php echo $item['id'];?>>
								<button  type="submit" class="btn btn-success" >
									<span class=" glyphicon glyphicon-edit">
									</span>
								</button>
							</form>
							<form name="form" action="" method="post">
								<input type = 'hidden' name = 'removeItem', value = <?php echo $item['id'];?>>
								<button  type="submit" class="btn btn-danger" >
									<span class="glyphicon glyphicon-remove">
									</span>
								</button>
							</form>
						 </td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>