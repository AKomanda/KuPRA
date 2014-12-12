<?php
	include_once 'core/init.php';
	$errors = array();
	$success = array();
	$admin = User::current_user()->isAdmin();
	
	if(isset($_POST['name'])){
		$validator = new Validation();
		$validator->measureValidation($_POST['short'], $_POST['name']);
		$errors = $validator->getErrors();
		if(empty($errors)){
			databaseController::getDB()->insert('matavimo_vienetai', array(
				'Autorius' => User::current_user()->id,
				'Trumpinys' => $_POST['short'],
				'Pavadinimas' => $_POST['name']));	
			$success[] = 'Matavimo vienetas sukurtas!';		
		}
	}
	if(isset($_POST['remove'])){
		databaseController::getDB()->delete('matavimo_vienetai', array('ID', '=', $_POST['item']));
	}
	if(isset($_POST['edit'])){
	}
	$measures = Measure::getAllMeasures();
?>

<div class='row'>
	<div class='col-xs-5'>
		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Matavimo vieneto kūrimias</h3>
			 	</div>
			  	<div class="panel-body">
			  	<?php 	
			  	$count = 1;
				foreach($errors as $error){
  					echo "<font size='2' color='red'>{$count}.{$error}</font><br>";
  					$count +=1;
  				} 
				foreach($success as $s){
  					echo "<font size='2' color='green'>{$s}</font><br>";
  				} ?>
			    	<form method="post" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Pavadinimas" name="name" type="text">
			    		</div>
			    		<div class="form-group">
			    		    <input class="form-control" placeholder="Trumpinys" name="short" type="text">
			    		</div>
			    		<input class="btn btn-success btn-block" type="submit" value="Sukurti">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
	</div>
	<div class='col-xs-7'>
		<div class="listContainer">
			<div class="table-responsive">
				<table class="table table-boarded table-stripped">
					<thead>
						<th>Autorius</th>
						<th>Pavadinimas</th>
						<th>Sutrumpinimas</th>
						<?php if($admin){?>
						<th>Veiksmai</th>
						<?php }?>
					</thead>
					<tbody>
						<?php 
						foreach($measures as $measure){
							$authName = User::getUser($measure->Autorius)->nick;
						?>
						<tr class="listItemContainer">
						<td class = 'matVntAutStulpelis'><?php echo $authName; ?></td>
						<td class = 'matVntPavStulpelis'><?php echo $measure->Pavadinimas; ?></td>
						<td class = 'matVntTrumpStulpelis'><?php echo $measure->Trumpinys; ?></td>
						<?php if($admin && !Measure::isUsed($measure->ID)){?>
						<td class = 'matVntVeiksStulpelis'>
							<form name="form" action="" method="post">
								<input type = 'hidden' name = 'item', value = <?php echo $measure->ID;?>>
								<div class="btn-group" role="group" aria-label="...">
									<div class="btn-group" role="group">
									<button name='edit'  type="submit" class="btn btn-success" >
										<span class=" glyphicon glyphicon-edit">
										</span>
									</button>
									</div>
									<div class="btn-group" role="group">
									<button name="remove" type="submit" class="btn btn-danger" >
										<span class="glyphicon glyphicon-remove">
										</span>
									</button>
									</div>
								</div>
							</form>
						</td>
						<?php }else{ echo '<td></td>'; } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>