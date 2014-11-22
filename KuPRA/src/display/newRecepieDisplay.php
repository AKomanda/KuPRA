<?php
?>

<div class="mainContainer">
	<div class="title">
		<h1>Pridėti receptą</h1>
	</div>
	<div class="inputFields">
		<div class="form-style-2">
			<form action="" method="post">
				<label for="field1">
					<span>Pavadinimas 
						<span class="required">*</span>
					</span>
					<input type="text" class="input-field" name="field1" value="" />
				</label>
				<label	for="field2">
					<span>Porcijų skaičius 
						<span class="required">*</span>
					</span>
					<input type="text" class="input-field" name="field2" value="" />
				</label>
				<label for="field3">
					<span>Gamybos trukmė<span
							class="required">*</span>
					</span>
					<input type="text" class="input-field" name="field3" value="" />
				</label>
				<label for="newProduct">
					<span>Gamybos trukmė<span
							class="required">*</span>
					</span>
					<input type="button" name="newProduct" value="+"/>
				</label>
				<label for="field4">
					<span>Gamybos aprašymas <span
							class="required">*</span>
					</span>
					<textarea name="field4" rows="5" cols="30"></textarea>
				</label>
				<label>
					<span>&nbsp;</span>
					<input type="submit" value="Submit" />
				</label>
			</form>
		</div>
	</div>
</div>