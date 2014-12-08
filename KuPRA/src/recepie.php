
<!DOCTYPE html>
<html>
<head>
<!-- <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>  -->
<link rel="stylesheet" type="text/css" href="styles/main.css">

<!-- jQuery library (served from Google) -->
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="styles/jquery.carouFredSel-6.0.4-packed.js"></script>
<script src="styles/imgs.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<meta charset="UTF-8">
<title>Title of the document</title>
</head>
<?php
include_once "display/topBar.php";	
?>
<body>
	<div class="container">

	<div class = 'row'>
		<div class = 'col-xs-12'>
		 	<?php include_once "display/topNav.php"; ?>
		</div>
	</div>
	<div class='row'>
		<div class = 'col-xs-9'>
		  <div class = 'jumbotron'>
		  	<?php include_once "display/recepiedisplay.php"; ?>
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