<?php
include_once "display/pageHeader.php";
include_once 'core/init.php';
if(user::isLoggedIn()){
	header("Location: index.php");
}
?>
<html>
<body>
<?php  include_once "display/topBar.php";?>
<div class="container">
<?php
//include_once "display/topNav.php";
//include_once "display/sideNav.php";
include_once "display/registerDisplay.php";
include_once "class/databaseController.php";
//include_once "class/user.php";
//include_once "class/Validation.php";

?>
</div>
</body>

</html>