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

<div class="container">
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Registracija</h3>
			 	</div>
			  	<div class="panel-body">
			  	<?php 	$count = 1;
				foreach($errors as $error){
  				echo "<font size='3' color='red'>{$count}.{$error}</font><br>";
  				$count +=1;
  				} ?>
			    	<form method="post" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" value="<?php echo $email;  ?>" placeholder="El. PaÅ�tas" name="email" type="text">
			    		</div>
			    		<div class="form-group">
			    		    <input class="form-control" value="<?php echo $login;  ?>" placeholder="Prisijungimo vardas" name="login" type="text">
			    		</div>
			    		<div class="form-group">
			    		    <input class="form-control" value="<?php echo $nick;  ?>" placeholder="Slapyvardis" name="nick" type="text">
			    		</div>
			    		<div class="form-group">
			    		    <input class="form-control" placeholder="SlaptaÅ¾odis" name="password" type="password">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Pakartokite slaptaÅ¾odį" name="password_again" type="password" value="">
			    		</div>
			    		<input class="btn btn-success btn-block" type="submit" value="Registruotis">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>

