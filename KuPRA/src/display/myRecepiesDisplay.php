<?php
include_once 'core/init.php';
$perPage = 12;
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

$allRecepies = recepie::allForUserById (user::current_user()->id);
$recordCount = count($allRecepies);
if($recordCount > $offset){
	$recepies = array_slice($allRecepies, $offset, $perPage);
}else{
	$recepies = array();
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
	<div class = 'row'>
			<div class = 'col-xs-12'>
				<p style="text-align:center;">
					<?php if($offset > 0){
						$prevPage = $page - 1;
						echo "<a href = 'myrecepies.php?page={$prevPage}'><span class='glyphicon glyphicon-arrow-left'></a>";
					}
					if($offset > 0 || $recordCount > $offset + $perPage){
						echo $page;
					}	
					if($recordCount > $offset + $perPage){
						$secondPage = $page +1;
						echo "<a href = 'myrecepies.php?page={$secondPage}'><span class='glyphicon glyphicon-arrow-right'></a>"; 
					}
					?>
				</p>
			</div>
		</div>
</div>