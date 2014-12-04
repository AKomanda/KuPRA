<?php
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
					<label>Porcijų skaičius</label> <input type="text"
						name="recipeName" />
					<div class="clear"></div>
					<label>Gaminimo laikas</label> <input type="text" name="recipeName" />
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
						<tbody>
							<tr>
								<td><input type="text" name="ingredient" /></td>
								<td><select>
										<option>1 vienetas</option>
										<option>2 vienetas</option>
								</select></td>
								<td><input class="small" type="text" name="quantity" /></td>
								<td><input type="button" class="add" name="add" value="+" /></td>
							</tr>
						</tbody>
					</table>
				</fieldset>
				<fieldset class="description"></fieldset>
				<fieldset class="photos"></fieldset>
			</div>
			<div class="rightSide">
				<fieldset class="type">
				<input type="checkbox" />Karšti <br>
				<input type="checkbox" />Šalti patiekalai<br>
				<input type="checkbox" />Užkandžiai patiekalai<br>
				<input type="checkbox" />random patiekalai<br>
				<input type="checkbox" />kitas random patiekalai<br>
				<input type="checkbox" />paskutinis random patiekalai<br>
				
				</fieldset>
			</div>
		</form>
	</div>

</div>