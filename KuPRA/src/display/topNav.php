

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
	    		<button type="button" class="btn btn-success">Receptai</button>
	  		</div>
	  		<div class="btn-group" role="group">
	   			<button type="button" class="btn btn-success">Ieškoti receptų</button>
	  		</div>
	  		<div class="btn-group" role="group">
	  			  <button type="button" class="btn btn-success">Šaldytuvas</button>
	 		</div>
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-success"id="products">Produktai</button>
	    		<script type="text/javascript">
		   			document.getElementById("products").onclick = function () {
		        	location.href = "products.php";
		    		};
				</script>
	  		</div>
		</div>
	</div>
</html>