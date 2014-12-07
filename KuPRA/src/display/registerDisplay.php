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
  			header('Location: index.php');
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
				<input type = "text" name = "email" value = "<?php echo $email;  ?>" autocomplete = "off" placeholder='El. Paštas'> <br><br>
			</div>
			<div class= "field">
				<input type = "text" name="login" value = "<?php echo $login;  ?>" autocomplete = "off"placeholder='Prisijungimo vardas'> <br><br>
			</div>
			<div class= "field">
				<input type="text" name="nick" value="<?php echo $nick;  ?>" autocomplete = "off"placeholder='Slapyvardis'> <br><br>
			</div>
			<div class= "field">
				<input type = "password" name = "password" value = ""placeholder='Slaptažodis'> <br><br>
			</div>
			<div class= "field">
				<input type = "password" name = "password_again" value = ""placeholder='Pakartoti slaptažodį'> <br><br>
			</div>
			
			<input type = "submit", value = "register">
		</form>
	</div>
</div>

