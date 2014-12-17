

<?php
include_once "display/pageHeader.php";
include_once 'core/init.php';
if(!User::isLoggedIn()){
	header("Location: welcome.php");
}
$id = User::current_user()->id;

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
		  <div class = 'mainContainer'>
		  	<?php include_once "display/meniuDisplay.php"; ?>
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
