<?php
include_once 'core/init.php';
$rcp = recepie::allPublic ();
if (isset($_GET['type'])) {
	if ($_GET['type'] == 'p') {
		$res = array();
		foreach($rcp as $r) {
			$temp = array ();
			$req = recepie::getRequiredProducts($r[0]->ID);
			$temp = fridge::searchMissing(user::current_user()->id, $req, '1');
			if (empty($temp)) {
				array_push($res, $r);
			}
		}
		$recepies = $res;
	} else {
		$recepies = $rcp;
	}
} else {
	$recepies = $rcp;
}
?>
<div class="row">
	<div class="container-fluid js-masonry"
		data-masonry-options='{ "gutter": 10 }'>
	<?php
	foreach ( $recepies as $receptas ) {
		?>
		<div class='thumbnail'>
			<div class='receptoPavadinimas'>
				<h4><?php echo $receptas[0]->Pavadinimas; ?></h4>
			</div>
			<?php echo "<a href='recepie.php?id=" . $receptas[0]->ID . "'>"?>
			<div class='receptoNuotrauka'>
				<img src="<?php echo $receptas[1]; ?>" />
			</div>
			</a>
			<div class='caption'>

				<p><?php echo substr($receptas[0]->Aprasymas, 0, 100); ?></p>
			</div>
		</div>
		<?php
	}
	?>

</div>
</div>