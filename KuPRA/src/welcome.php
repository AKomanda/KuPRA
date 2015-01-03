<?php
include_once "display/pageHeader.php";
include_once 'core/init.php';
if(User::isLoggedIn()){
	header("Location: index.php");
}
?>

<body>
<?php  include_once "display/topBar.php";?>
<div class ="container welcomingContainer">
<div class="row ">
<div class="col-lg-12">
	<div class="text-vertical-center">
		<span class="name">Sveiki atvykę į KuPRA svetainę</span>
	</div>
<p class="lead text-center">Sveiki atvykę į KuPRA svetainę</p>
				<p class="lead text-center">KuPRA - tai <strong>Ku</strong>linarinių <strong>P</strong>atiekalų <strong>R</strong>uošimo <strong>A</strong>sistentas.</p>
				<p class="lead text-center">Pilnam šios sistemos naudojimui reikalinga registracija.</font><p>
					<p class="lead text-center">
						<div class="suround text-center">
						<button type="button" class="btn btn-primary" id = 'reg'>Registruotis</button>&nbsp;-&nbsp;arba&nbsp;-
						
						<button type="button" class="btn btn-primary" id = 'login'>Prisijungti</button>
						</div>
					</p>
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
</body>
