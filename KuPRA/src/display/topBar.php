<?php
	include_once "core/init.php";
	
	function logout(){
		User::logout();
		header('Location: login.php');
	}
	
	if(isset($_GET['logout'])){
		logout();
	}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            	<?php 
					if(User::isLoggedIn()){
							echo '<a class="navbar-brand" href="index.php">KuPRA</a>';
						}else{
							echo '<a class="navbar-brand" href="#">KuPRA</a>';
						}
  				?>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if(User::isLoggedIn()){
        	echo "<li><a href='index.php'>Pradžia</a></li>";
        	echo "<li><a href=''>Pagalba</a></li>";
        	echo "<li><a href=''>Profilis</a></li>";
        	echo "<li><a href='index.php?logout=true'>Atsijungti</a></li>";
        }else{
        	echo "<li><a href='register.php'>Registracija</a></li>";
        	echo '<li><a href="login.php">Prisijungti</a></li>';
        }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
