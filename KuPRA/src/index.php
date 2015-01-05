<?php
include_once "display/pageHeader.php";

//include_once "display/topNav.php";
include_once "class/databaseController.php";
include_once 'core/init.php';
if(!user::isLoggedIn()){
	header("Location: welcome.php");
}
$allTopRecepies =  databaseController::getDB()->query('SELECT * FROM receptai ORDER BY Vertinimas DESC')->results();
if(count($allTopRecepies) > 10){
	$topRecepies = array_slice($allTopRecepies, 0, 10);
}else{
	$topRecepies = $allTopRecepies;
}
$first = true;

?>


<body>
<?php include_once "display/topBar.php"; ?>
	<div class="container">

	<div class = 'row'>
		<div class = 'col-xs-12'>
		 	<?php include_once "display/topNav.php"; ?>
		</div>
	</div>
	<div class='row'>
		<div class = 'col-xs-9'>
		
		  <div class = 'mainContainer mainas'>
		  	<h3 style = 'text-align: center'>Receptų top 10</h3>
		  	<div class = 'row'>
			<div class="container-fluid js-masonry" data-masonry-options='{ "gutter": 10 }'>
				<?php
					foreach ( $topRecepies as $receptas ) {
						$photo = recepie::photo($receptas->ID);
				?>
				<div class='thumbnail index'>
					<div class='receptoPavadinimas'>
						<h4><?php echo $receptas->Pavadinimas; ?></h4>
					</div>
					<?php echo "<a href='recepie.php?id=" . $receptas->ID . "'>"?>
					<div class='receptoNuotrauka'>
						<img src="<?php echo $photo; ?>" />
					</div>
					</a>
					<div class='caption'>	
						<p>Vertinimas: <?php echo $receptas->Vertinimas;?>/10</p>
					</div>
				</div>
				<?php
				}
				?>				
			</div>
			</div>
		  </div>
		
		</div>
		<div class = 'col-xs-3'>
		  <div class = 'mainContainer'>
			<?php include_once "display/sideNav.php"; ?>
		  </div>
		</div>
	</div>
	</div>
<script type = 'text/javascript'>
$(document).ready(function(){
	$('.carousel .item').each(function(){
	  var next = $(this).next();
	  if (!next.length) {
	    next = $(this).siblings(':first');
	  }
	  next.children(':first-child').clone().appendTo($(this));
	  
	  if (next.next().length>0) {
	    next.next().children(':first-child').clone().appendTo($(this));
	  }
	  else {
	  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
	  }
	});
});
</script>
</body>
</html>

