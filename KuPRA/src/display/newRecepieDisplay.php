<?php
?>

<div class="mainContainer">
	<div class="title">
		<h1>Pridėti receptą</h1>
	</div>
	<div class="inputFields">
		<div class="form-style-2">
			<form action="" method="get">
				<label for="name">
					<span>Pavadinimas 
						<span class="required">*</span>
					</span>
					<input type="text" class="input-field" name="name" value="" />
				</label>
				
				<label	for="portions">
					<span>Porcijų skaičius 
						<span class="required">*</span>
					</span>
					<input type="text" class="input-field short-input" name="portions" value="" />
				</label>
				
				<label for="length">
					<span>Gamybos trukmė<span
							class="required">*</span>
					</span>
					<input type="text" class="input-field short-input" name="length" value="" />
					<span style="float: none; padding-left: 2px;" >min.</span>
				</label>
				
				<label for="addProducts">
					<span>Produktai<span
							class="required">*</span>
					</span>
					<div class="addProducts">
						<div id="pr1" >
							<input type="text" class="input-field mid-input productName" name="prName" />
							<input type="text" class="input-field short-input productQuantity" name="prQuan" />
							<input type="" class="input-field short-input productMeasure" name="prMeasure" />
							<input type="button" class="removePr" name="removeProduct" value="-"/>
						</div>
						<span>&nbsp;</span>
						<div id="pr2" >
							<input type="text" class="input-field mid-input productName" name="prName" />
							<input type="text" class="input-field short-input productQuantity" name="prQuan" />
							<input type="" class="input-field short-input productMeasure" name="prMeasure" />
							<input type="button" class="newPr" onclick="pridetiEilute()" name="newProduct" value="+"/>
						</div>
					</div>
				</label>
				
				<label for="descr">
					<span>Gamybos aprašymas <span
							class="required">*</span>
					</span>
					<textarea name="descr" rows="5" cols="30"></textarea>
				</label>
				<label for="field5">
					<span>Nuotraukos</span>
					<input name="field5" type="file" />
				</label>
				<label>
					<span>&nbsp;</span>
					<span>Privatus? <input type="checkbox" name="privatus" /></span>
					<input type="submit" value="Submit" />
				</label>
			</form>
		</div>
	</div>
</div>