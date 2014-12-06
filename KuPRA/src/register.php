<?php
?>

<!DOCTYPE html>
<html>
<head>
<!-- <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>  -->
<link rel="stylesheet" type="text/css" href="styles/main.css">

<!-- jQuery library (served from Google) -->
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="styles/jquery.carouFredSel-6.0.4-packed.js"></script>
<script src="styles/imgs.js"></script>

</head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<div class="awesomePage">
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