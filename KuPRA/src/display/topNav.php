

<?php
?>
<html>
	<head>
		
	</head>
	<div class="">
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  		<div class="btn-group" role="group">
	   			 <button type="button" class="btn btn-success"  id="pradzia">Pagrindinis</button>
	  		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success" id="recepies">Receptai</button>
	  		</div>
	  		<div class="btn-group" role="group">
	  			  <button type="button" class="btn btn-success" id="fridge">Šaldytuvas</button>
	 		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success" id="products">Produktai</button>
	  		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success" id="mesures">Matavimo vienetai</button>
	  		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success" id="users">Vartotojai</button>
	  		</div>
	  		<script type="text/javascript">
	    		document.getElementById("products").onclick = function () {
		        	location.href = "products.php";
		    		};
		    	document.getElementById("recepies").onclick = function () {
			       	location.href = "recepies.php";
			    	};
			    document.getElementById("fridge").onclick = function () {
				   	location.href = "fridge.php";
				    };
				document.getElementById("pradzia").onclick = function () {
			       	location.href = "index.php";
			    	};
			   	document.getElementById("mesures").onclick = function () {
				   	location.href = "measures.php";
				    };
			    document.getElementById("users").onclick = function () {
			   	location.href = "users.php";
					};
				</script>
		</div>
	</div>
</html>