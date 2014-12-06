<?php
  include_once 'core/init.php'; 
  
  $errors = array();
  $email = '';
  $login = '';
  $nick = '';
  
  if (!empty($_POST)) {
  	$validator = new Validation();
  	$validator->regValidation($_POST);
  	$errors = $validator->getErrors();
  	$email = $_POST['email'];
  	$login = $_POST['login'];
  	$nick = $_POST['nick'];
  	if(empty($errors)){
  		if(User::create($_POST)){
  			//redirect to index
  		}else{
  			$errors[] = 'something vent wrong';
  		}
  	}
  }

?>
<div class="mainContainer">
	<div id="container" class="js-masonry">
		<?php 	foreach($errors as $error){
  				echo "<font size='3' color='red'>{$error}</font><br>";
  				} ?>
		<form action="" method="post">
			<div class= "field">
				<label for="email">Email</label>
				<input type = "text" name = "email" value = "<?php echo $email;  ?>" autocomplete = "off"> <br><br>
			</div>
			<div class= "field">
				<label for="login">Prisijungimo vardas</label>
				<input type = "text" name="login" value = "<?php echo $login;  ?>" autocomplete = "off"> <br><br>
			</div>
			<div class= "field">
				<label for="nick">Slapyvardis</label>
				<input type="text" name="nick" value="<?php echo $nick;  ?>" autocomplete = "off"> <br><br>
			</div>
			<div class= "field">
				<label for="password">Slaptažodis</label>
				<input type = "password" name = "password" value = ""> <br><br>
			</div>
			<div class= "field">
				<label for="password_again">Pakartoti slaptažodį</label>
				<input type = "password" name = "password_again" value = ""> <br><br>
			</div>
			
			<input type = "submit", value = "register">
		</form>
	</div>
</div>

