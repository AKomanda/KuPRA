<?php
	include_once "core/init.php";
	
	function logout(){
		User::logout();
		header('Location: index.php');
	}
	
	if(isset($_GET['logout'])){
		logout();
	}
?>
<header class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <a href='' id="logo">KuPRA</a>
    <nav>
      <ul class="nav navbar-nav pull-right">
        <?php if(User::isLoggedIn()){
        	echo "<li><a href=''>Pradžia</a></li>";
        	echo "<li><a href=''>Pagalba</a></li>";
        	echo "<li><a href=''>Profilis</a></li>";
        	echo "<li><a href='index.php?logout=true'>Atsijungti</a></li>";
        }else{
        	echo "<li><a href='register.php'>Registracija</a></li>";
        	echo '<li><a href="login.php">Prisijungti</a></li>';
        }?>
      </ul>
    </nav>
  </div>
</header>