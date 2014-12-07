<?php
include_once 'core/init.php';

$errors = array ();
$login = '';

if (! empty ( $_POST )) {
	$validator = new Validation ();
	$validator->loginValidation ( $_POST ['login'], $_POST ['password'] );
	$errors = $validator->getErrors ();
	$login = $_POST ['login'];
	if (empty ( $errors )) {
		if (User::login ( $_POST ['login'], $_POST ['password'] )) {
			header ( 'Location: index.php' );
		} else {
			$errors [] = 'Neteisingi prisijungimo vardas ir/arba slaptažodis';
		}
	}
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Prisijunkite</h3>
				</div>
				<div class="panel-body">
			  			<?php
								$count = 1;
								foreach ( $errors as $error ) {
									echo "<font size='3' color='red'>{$count}.{$error}</font><br>";
									$count ++;
								}
								?>
			    	<form accept-charset="UTF-8" role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" value="<?php echo $login;  ?>"
									placeholder="Prisijungimo vardas" name="login" type="text">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password"
									name="password" type="password" value="">
							</div>
							<input class="btn btn-success btn-block" type="submit"
								value="Login">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

