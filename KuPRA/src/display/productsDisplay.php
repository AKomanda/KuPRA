<?php
	include_once 'core/init.php';
?>
<h1>Produktai</h1>
<div class="listContainer">
	<div class="table-responsive">
		<table class="table table-boarded table-stripped">
			<thead>
				<th></th>
				<th>Pavadinimas</th>
				<th>Aprašymas</th>
				<th>Matavimo vienetai</th>
			</thead>
			<tbody>
			
				<?php 
				$products = Product::all();
				foreach($products as $productInfo){
					$product = Product::getProduct($productInfo->ID);
				?>
				<tr class="listItemContainer">
					<td class="produktoNuotraukosStulpelis"><div class="produktoNuotrauka"><img src=<?php echo $product->picture; ?>></div></td>
					<td class="produktoPavadinimoStulpelis">
						<h4><?php echo $product->name; ?></h4>
						<a href=""><?php echo User::getUser($product->author)->nick; ?></a>
					</td>
					<td><t><?php echo $product->description ?></t></td>
					<td class = "produktoMatStulpelis">
						<div class="dropdown">
						<a data-target="#" data-toggle="dropdown" class="dropdown-toggle" href="#">
						Matavimo vienetai
                        <b class="caret"></b>
                        </a>
						<ul class="dropdown-menu">
							<?php 
								foreach($product->measurementUnits as $unit){
								echo "<li role='presentation' class='dropdown-header'>{$unit[2]}</li>";
								}
							?>
						</ul>
						</div>
					</td>
				</tr>
				<?php }?>			
			</tbody>
		</table>
	</div>
</div>		
<button type="button" class="btn btn-success" id="newProduct">Sukurti produktą</button>
