<?php
?>

<!DOCTYPE html>
<html>
<head>
<!-- <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>  -->
<link rel="stylesheet" type="text/css" href="styles/main.css">
<link rel="stylesheet" type="text/css" href="styles/register.css">

<!-- jQuery library (served from Google) -->
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="styles/jquery.carouFredSel-6.0.4-packed.js"></script>
<script src="styles/imgs.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<div class="container">
<?php
include_once "display/topBar.php";
include_once "display/topNav.php";
include_once "display/sideNav.php";
include_once "display/registerDisplay.php";
include_once "class/databaseController.php";
include_once "class/user.php";
include_once "class/Validation.php";

?>
</div>
</body>

</html>