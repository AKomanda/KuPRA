<?php

if($_POST){
	var_dump($_POST);
}
?>

<div class="mainContainer">
	<div class="title">
		<h1>Pridėti receptą</h1>
	</div>
	<div class="recipesForm">
		<form method="post" class="createForm">
			<div class="leftSide">
				<fieldset class="info">
					<label>Pavadinimas</label> <input type="text" name="recipeName" />
					<div class="clear"></div>
					<label>Porcijų skaičius</label> <input class="short" type="text"
						name="portions" />
					<div class="clear"></div>
					<label>Gaminimo laikas</label> <input class="short" type="text"
						name="time" />&nbsp; min.
				</fieldset>
				<fieldset class="ingredients">
					<label>Produktai</label>
					<table>
						<thead>
							<tr>
								<td>Produktas</td>
								<td>Matavimo vienetas</td>
								<td>Kiekis</td>
							</tr>
						</thead>
						<tbody class="productsContainer">
							<tr class="row">
								<td><input type="text" name="ingredient[]" id="searchid"
									class="search">
									<div id="result"></div></td>
								<td><select name="venetai[]">
										<option>1 vienetas</option>
										<option>2 vienetas</option>
								</select></td>
								<td><input class="small" type="text" name="quantity[]" /></td>
								<td><input type="button" class="add" name="add" value="+" /></td>
							</tr>
						</tbody>
					</table>

				</fieldset>
				<fieldset class="description" >
					<label>Gaminimo aprašmas</label>
					<textarea name="description" rows="5" cols="45"></textarea>
				</fieldset>
				<fieldset class="photos">
					<label>Nuotraukos</label> <input type="file" />
				</fieldset>
				<fieldset style="float: right;" class="confirm">
					Privatus? &nbsp;<input name="privacy" type="checkbox" /> <input type="submit"
						value="Pridėti" />
				</fieldset>
			</div>
			<div class="rightSide">
				<fieldset class="type">
				</fieldset>
			</div>
		</form>
	</div>
</div>
