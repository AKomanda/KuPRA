<?php
?>

<div>
	<button class="btn btn-success btn-block" id="newRecepie">Pridėti receptą</button>	
	<button class="btn btn-success btn-block"id="myRecepie">Mano Receptai</button>
	<button class="btn btn-success btn-block" id="myMenu">Mano valgiaraštis</button>
	<button class="btn btn-success btn-block" id="whatToPrepare">Ką galiu pagaminti?</button>
	<script type="text/javascript">
		document.getElementById("newRecepie").onclick = function () {
		location.href = "newrecepie.php";
		};
		document.getElementById("myRecepie").onclick = function () {
		location.href = "myrecepies.php";
		};
		document.getElementById("myMenu").onclick = function () {
		location.href = "mymeniu.php";
		};
		document.getElementById("whatToPrepare").onclick = function () {
		location.href = "recepies.php?type=p";
		};
	</script>
</div>