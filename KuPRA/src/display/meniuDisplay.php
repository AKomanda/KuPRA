<?php
include_once 'core/init.php';
$meniu = meniu::getMeniu ( $id );
?>
<div class="row">
<div class="container-fluid js-masonry"
		data-masonry-options='{ "gutter": 10 }'>
	<?php 
	foreach ( $meniu->recepies as $receptas ) {
		echo ""?>
		<div class='thumbnail'>
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
</div>
