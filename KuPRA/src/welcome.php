<?php
include_once "display/pageHeader.php";
include_once 'core/init.php';
if(User::isLoggedIn()){
	header("Location: index.php");
}
?>

<html>
<body>
<?php  include_once "display/topBar.php";?>
<div class ="container">
	<div class ='row'>
		<div class = 'col-xs-12'>
			<div class="mainContainer">
				<h1>Sveiki atvykę į KuPRA svetainę</h1>
				<font>KuPRA - tai <strong>Ku</strong>linarinių <strong>P</strong>atiekalų <strong>R</strong>uošimo <strong>A</strong>sistentas.</font><br>
				<font>Pilnam šios sistemos naudojimui reikalinga registracija.</font><br>
				<button type="button" class="btn btn-success" id = 'reg'>Registruotis</button>
				<button type="button" class="btn btn-success" id = 'login'>Prisijungti</button>
				<script type="text/javascript">
	    		document.getElementById("reg").onclick = function () {
		        	location.href = "register.php";
		    		};
		    	document.getElementById("login").onclick = function () {
			       	location.href = "login.php";
			    	};
				</script>
			</div>
		</div>
	</div>
</div>
</body>

</html>
