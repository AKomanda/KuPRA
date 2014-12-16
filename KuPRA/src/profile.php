<?php
include_once "display/pageHeader.php";

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
		  <div class = 'profileContainer'>
		  	<?php include_once "display/profileDisplay.php"; ?>
		  </div>
		</div>
		<div class = 'col-xs-3'>
		  <div class = 'mainContainer'>
		  	<?php include_once "display/sideNav.php"; ?>
		  </div>
		</div>
	</div>
	</div>
</body>

</html>