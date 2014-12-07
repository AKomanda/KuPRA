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
<div class="col-md-4 col-md-offset-4 panel panel-default">
	<div id="container" class="panel-body">
		<?php 	$count = 1;
				foreach($errors as $error){
  				echo "<font size='3' color='red'>{$count}.{$error}</font><br>";
  				$count +=1;
  				} ?>
		<form action="" method="post">
			<div class= "field">
				<input type = "text" name = "email" value = "<?php echo $email;  ?>" autocomplete = "off" placeholder='El. Paštas' class='form-control'> <br><br>
			</div>
			<div class= "field">
				<input type = "text" name="login" value = "<?php echo $login;  ?>" autocomplete = "off"placeholder='Prisijungimo vardas' class='form-control'> <br><br>
			</div>
			<div class= "field">
				<input type="text" name="nick" value="<?php echo $nick;  ?>" autocomplete = "off"placeholder='Slapyvardis' class='form-control'> <br><br>
			</div>
			<div class= "field">
				<input type = "password" name = "password" value = ""placeholder='Slaptažodis' class='form-control'> <br><br>
			</div>
			<div class= "field">
				<input type = "password" name = "password_again" value = ""placeholder='Pakartoti slaptažodį' class='form-control'> <br><br>
			</div>
			
			<input type = "submit", value = "register", class="btn btn-success btn-block">
		</form>
	</div>
</div>

