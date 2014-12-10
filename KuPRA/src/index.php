<?php
include_once "display/pageHeader.php";

//include_once "display/topNav.php";
include_once "class/databaseController.php";
include_once "core/init.php";


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
		  <div class = 'jumbotron'>
		  </div>
		</div>
		<div class = 'col-xs-3'>
		  <div class = 'jumbotron'>
			<?php include_once "display/sideNav.php"; ?>
		  </div>
		</div>
	</div>
	</div>
</body>
</html>

