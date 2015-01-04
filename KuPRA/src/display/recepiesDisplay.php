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

if(isset($_GET['search'])){
	$allRcp = recepie::search($_GET['search']);
}else{
	$allRcp = recepie::allPublic ();
}

$recordCount = count($allRcp);
if($recordCount > $offset){
	$rcp = array_slice($allRcp, $offset, $perPage);
}else{
	$rcp = array();
}

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
<div class = row>
  <div class="col-md-6">
  	<div class = 'search'>
	 	 <form name="form" action="" method="get">
		  	<div class="input-group">
	 			 <input type="text" name="search" class="form-control" placeholder="Ieškoti receptų">
	 			 <span class="input-group-btn">
	        		<button type="submit"class="btn btn-success go inline"><span class="glyphicon glyphicon-search"></span></button> 
	      		 </span>  
			</div>
		</form>
	</div>
  </div>
</div>
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
					<?php 
					if(isset($_GET['search'])){
						if($offset > 0){
							$prevPage = $page - 1;
							echo "<a href = 'recepies.php?search={$_GET['search']}&page={$prevPage}'><span class='glyphicon glyphicon-arrow-left'></a>";
						}
							if($offset > 0 || $recordCount > $offset + $perPage){
							echo $page;
							}
								
							if($recordCount > $offset + $perPage){
							$secondPage = $page +1;
								echo "<a href = 'recepies.php?search={$_GET['search']}&page={$secondPage}'><span class='glyphicon glyphicon-arrow-right'></a>";
							}
					}else{
						if($offset > 0){
							$prevPage = $page - 1;
							echo "<a href = 'recepies.php?page={$prevPage}'><span class='glyphicon glyphicon-arrow-left'></a>";
						}
							if($offset > 0 || $recordCount > $offset + $perPage){
							echo $page;
							}
								
							if($recordCount > $offset + $perPage){
							$secondPage = $page +1;
								echo "<a href = 'recepies.php?page={$secondPage}'><span class='glyphicon glyphicon-arrow-right'></a>";
							}
					}
					
					?>
				</p>
			</div>
		</div>
</div>