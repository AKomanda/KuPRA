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
  			header('Location: index.php');
  		}else{
  			$errors[] = 'Neteisingi prisijungimo vardas ir/arba slaptažodis';
  		}
  	}
  }
?>
<div class="col-md-4 col-md-offset-4 panel panel-default">
	<div id="container" class="panel-body">
		<?php 	$count = 1;
				foreach($errors as $error){
  				echo "<font size='3' color='red'>{$count}.{$error}</font><br>";
  				$count ++;
				} ?>
		<form action="" method="post">
			<div class= "field">
				<input type = "text" name="login" value = "<?php echo $login;  ?>" autocomplete = "off" placeholder='Prisijungimo vardas' class='form-control'> <br><br>
			</div>
			<div class= "field">
				<input type = "password" name = "password" value = "" placeholder='Slaptažodis' class='form-control'> <br><br>
			</div>
			<input type = "submit", value = "Prisijungti" class="btn btn-success btn-block">
		</form>
	</div>
</div>
