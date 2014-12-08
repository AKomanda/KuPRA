<?php
include_once 'core/init.php';
$meniu = meniu::getMeniu ( $id );
?>
<div id="container" class="js-masonry">
	<?php 
	foreach($meniu->recepies as $receptas) {
		echo ""?>
		<div class='recepieContainer'>
			<div class='receptoPavadinimas'><?php echo $receptas->Receptas; ?></div>
			<?php echo "<a href='recepie.php?id=" . $receptas->ID . "'>" ?>
			<div class='receptoNuotrauka'><img src="<?php if (count($receptas->Nuotraukos) > 0) { echo $receptas->Nuotraukos[0]->Nuotrauka; } ?>" /></div>
			</a>
			<div class='miniReceptoBottom'>
				<div class='porcijuSkaicius'><?php  echo $receptas->Porciju_skaicius; ?></div>
				<div class='gaminimoData'><?php  echo $receptas->Gaminimo_data; ?></div>
			</div>
		</div>
		<?php 
	}
	?>
	</div>