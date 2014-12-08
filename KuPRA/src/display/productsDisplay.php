<?php
	include_once 'core/init.php';
?>
<h1>Produktai</h1>
<div class="listContainer">
	<div class="table-responsive">
		<table class="table table-boarded table-stripped">
			<tbody>
			
				<?php 
				$products = Product::all();
				foreach($products as $product){
				?>
				<tr class="listItemContainer">
					<td><div class="produktoNuotrauka"><img src=<?php echo $product->Nuotrauka; ?>></div></td>
					<td>
						<h4><?php echo $product->Pavadinimas; ?></h4>
						<a href=""><?php echo User::getUser($product->Autorius)->nick; ?></a>
					</td>
					<td><t><?php echo $product->Aprasymas ?></t></td>
				</tr>
				<?php }?>			
			</tbody>
		</table>
	</div>
</div>		
<button type="button" class="btn btn-success" id="newProduct">Sukurti produktą</button>
