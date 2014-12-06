<?php
  include_once 'core/init.php';
  
  $errors = array();
  $login = '';
  
  if (!empty($_POST)) {
  	$validator = new Validation();
  	$validator->loginValidation($_POST['login'], $_POST['password']);
  	$errors = $validator->getErrors();
  	$login = $_POST['login'];
  	if(empty($errors)){
  		if(User::login($_POST['login'], $_POST['password'])){
  			//success message
  		}else{
  			$errors[] = 'Neteisingi prisijungimo vardas ir/arba slaptažodis';
  		}
  	}
  }
  echo User::isLoggedIn();
  echo session_id();
?>
<div class="mainContainer">
	<div id="container" class="js-masonry">
		<?php 	foreach($errors as $error){
  				echo "<font size='3' color='red'>{$error}</font><br>";
  				} ?>
		<form action="" method="post">
			<div class= "field">
				<label for="login">Prisijungimo vardas</label>
				<input type = "text" name="login" value = "<?php echo $login;  ?>" autocomplete = "off"> <br><br>
			</div>
			<div class= "field">
				<label for="password">Slaptažodis</label>
				<input type = "password" name = "password" value = ""> <br><br>
			</div>
			<input type = "submit", value = "Prisijungti">
		</form>
	</div>
</div>
