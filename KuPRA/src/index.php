<?php
include_once "display/pageHeader.php";

//include_once "display/topNav.php";
include_once "class/databaseController.php";
include_once 'core/init.php';
if(!user::isLoggedIn()){
	header("Location: welcome.php");
}
$allTopRecepies =  databaseController::getDB()->query('SELECT * FROM receptai ORDER BY Vertinimas DESC')->results();
if(count($allTopRecepies) > 9){
	$topRecepies = array_slice($allTopRecepies, 0, 9);
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
		  
	<div id = 'car' class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
 
  <!-- Wrapper for slides -->

  <div class="carousel-inner">
  <?php foreach($topRecepies as $recepie){
  		$photo = recepie::photo($recepie->ID);
  		if($first){
  			$first = false;
  ?>
    <div class="item active">
      <div class="col-md-4">
      		<div class ='CarouselElement'>
      		<a href="recepie.php?id=<?php echo $recepie->ID; ?>">
	      		<div class="carousel-header" style = 'text-align: center;'>
          			<h3><?php echo $recepie->Pavadinimas ?></h3>
     			 </div>
				<img src="<?php echo $photo; ?>" class="img-responsive" />			
			</a>
			</div>
      	</div>
    </div>
    <?php }else{?>
    <div class="item">
      <div class="col-md-4">
      		<div class ='CarouselElement'>
      		<a href="recepie.php?id=<?php echo $recepie->ID; ?>">
	      		<div class="carousel-header" style = 'text-align: center;'>
          			<h3><?php echo $recepie->Pavadinimas ?></h3>
     			 </div>
				<img src="<?php echo $photo; ?>" class="img-responsive" />			
			</a>
			</div>
      	</div>
    </div>
    
    <?php }} ?>
  </div>
  <a class="left carousel-control" href="#car" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#car" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>

 
  <!-- Controls -->
  
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

