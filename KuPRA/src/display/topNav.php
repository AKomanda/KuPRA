

<?php
?>
<html>
	<head>
		
	</head>
	<div class="">
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  		<div class="btn-group" role="group">
	   			 <button type="button" class="btn btn-success"  id="pradzia">Pagrindinis</button>
	   			 <script type="text/javascript">
		   			document.getElementById("pradzia").onclick = function () {
		        	location.href = "index.php";
		    		};
				</script>
	  		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success" id="recepies">Receptai</button>
	  		</div>
	  		<div class="btn-group" role="group">
	   			<button type="button" class="btn btn-success">Ieškoti receptų</button>
	  		</div>
	  		<div class="btn-group" role="group">
	  			  <button type="button" class="btn btn-success" id="fridge">Šaldytuvas</button>
	 		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success" id="products">Produktai</button>
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
				</script>
	  		</div>
		</div>
	</div>
</html>