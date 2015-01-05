<?php
include_once "display/pageHeader.php";
include_once 'core/init.php';
if(user::isLoggedIn()){
	header("Location: index.php");
}
?>

<body>
<?php include_once "display/topBar.php";?>
<div class="container">
<?php

//include_once "display/topNav.php";
//include_once "display/sideNav.php";
include_once "display/loginDisplay.php";
?>
</div>
</body>

</html>