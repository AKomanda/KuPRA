<?php
	include_once 'core/init.php';
?>
<h1>Produktai</h1>
<div class="listContainer">
<?php
	$products = Product::all();
	foreach($products as $product){
?>	
<div class="listItemContainer">
	<ul class="media-list">
		<li class="madia">
			<a class="media-left">
				<div class="produktoNuotrauka">
					<img src=<?php echo $product->Nuotrauka; ?>>
				</div>
			</a>
			<div class="media-body">
				<h4 class="media-heading"><?php echo $product->Pavadinimas; ?> by <a href=""><?php echo User::getUser($product->Autorius)->nick; ?></a></h4>
				<t><?php echo $product->Aprasymas ?></t>
			</div>
		</li>
	</ul>	
</div>		
<?php		
	}
?>
</div>	
<button type="button" class="btn btn-success" id="newProduct">Sukurti produktą</button>
