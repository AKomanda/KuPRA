<?php
include_once 'core/init.php';
$meniu = meniu::getMeniu ( $id );

if(isset($_POST['buy'])){
	if(isset($_POST['include'])){
		$include = array();
		foreach($_POST['include'] as $inc){
			$include[] = unserialize($inc);
		}
		$fridge = User::current_user()->getFridgeContent();
		foreach($_POST['product'] as $key => $prod){
			if(in_array(array($_POST['product'][$key], $_POST['measure'][$key]), $include)){
				$exists = false;
				foreach($fridge as $i){
					if($i['product']->id == $_POST['product'][$key] && $i['mesure'] == $_POST['measure'][$key]){
						$exists = true;
						databaseController::getDB()->update('saldytuvas', array('Kiekis' => $i['amount'] + $_POST['amount'][$key]), array('ID', '=', $i['id']));
					}
				}
				if(!$exists){
					databaseController::getDB()->insert('saldytuvas', array(
						'Vartotojas' => User::current_user()->id,
						'Produktas' => $_POST['product'][$key],
						'Kiekis' => $_POST['amount'][$key],
						'Matavimo_vienetas' => $_POST['measure'][$key]));
				}
			}
		}
	}
	
	
}	
?>



<div class="row">
<div class="container-fluid js-masonry"
		data-masonry-options='{ "gutter": 10 }'>
	<?php 
	foreach ( $meniu->recepies as $receptas ) {
		echo ""?>
		<div class='thumbnail <?php if (recepie::isMadeByUser(user::current_user()->id, $receptas->MeniuID)) { echo " recepieMade"; } ?>'>
			<div class='receptoPavadinimas'><?php echo $receptas->Receptas; ?></div>
			<?php echo "<a href='recepie.php?id=" . $receptas->ID . "&m=". $receptas->MeniuID . "'>" ?>
			<div class='receptoNuotrauka'><img src="<?php if (count($receptas->Nuotraukos) > 0) { echo $receptas->Nuotraukos[0]->Nuotrauka; } ?>" /></div>
			</a>
			<div class='caption'>
				<p><?php echo substr($receptas->Aprasymas, 0, 100); ?></p>
			</div>
		</div>
		<?php 
	}
	?>
	</div>
	<button type="button" class="btn btn-default" data-toggle="modal" data-target=".modal">Ko man trūksta?</button>
</div>
		<div class="modal fade">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        				<h4 class="modal-title">Valgiaraščio receptų gaminimui trūkstamų produktų sąrašas.</h4>
      				</div>
      					<?php 
							$list = User::current_user()->getMenuProducts();
							if(is_string($list)){
								echo "<font>{$list}</font>";
								echo "<div class='modal-footer'>";
								echo "<button type='button' class='btn btn-default' data-dismiss='modal'>grįžti</button>";
								echo "</div>";
							}else{
      					?>
      					<form method="post" accept-charset="UTF-8" class="form-inline" role="form">
      					<div class="modal-body">
      						<table class="table table-boarded table-stripped">
      							<thead>
      								<th>Pavadinimas</th>
      								<th>Kiekis</th>
      								<th>Vienetas</th>
      								<th>Pridėti</th>
      							</thead>
      							<tbody>
		      						<?php foreach($list as $item){?>
		      						<tr>
		      							<?php $pav = databaseController::getDB()->get('maisto_produktai', array('ID', '=' ,$item['product'] ))->results()[0]->Pavadinimas ?>
		      							<td>
		      								<?php echo $pav; ?>
		      								<input type = "hidden" name = 'product[]' value ='<?php echo $item['product'] ?>'>
		      							</td>
		      							<td>
		      								<input type="number" min="0.01" value ="<?php echo $item['amount'] ?>" step="0.01" name ='amount[]' class="form-control">
		      							</td>
		      							<?php $measure = databaseController::getDB()->get('matavimo_vienetai', array('ID', '=', $item['measure']))->results()[0]->Pavadinimas ?>
		      							<td>
		      								<?php echo $measure; ?>
		      								<input type = "hidden" name = 'measure[]' value ='<?php echo $item['measure'] ?>'>
		      							</td>
		      							<td>		      								
		      								
											<input id = 'include' type="checkbox" name="include[]" value ='<?php echo serialize(array($item['product'], $item['measure'])); ?>' class="form-control" />		      								
		      							</td>
		      						</tr>
		      						<?php }?>
	      						</tbody>
      						</table>
      					</div>   				
      					<div class="modal-footer">
        					<button type="button" class="btn btn-default" data-dismiss="modal">grįžti</button>
        					<button type="submit" name="buy" class="btn btn-primary">Pirkti</button>
      					</div>
      					</form>
      					<?php }?>
    			</div><!-- /.modal-content -->
  			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
