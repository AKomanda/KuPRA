<?php
include_once 'core/init.php';
$user = User::current_user();
$errors = array();
$success = array();

if(isset($_POST['changePic'])){
	if(isset($_FILES['profilePic'])){
		$name = fileUploadController::changeProfilePic($_FILES['profilePic'], array("jpg", "jpeg", "png", "bmp"), 1024*1024*2,"/uploads/users/{$user->id}/");
		if($name!= false){
			databaseController::getDB()->update('vartotojas', array('Nuotrauka' => "../uploads/users/{$user->id}/{$name}"), array('ID', '=', $user->id));
			$success[] ='Profilio nuotrauka pakeistas';
			$user = User::current_user();
		}else{
			$errors[] = 'Nepavyko pakeisti profilio nuotraukos';
		}
	}else{
		$errors[] = 'Nepasirinktas jokas failas';
	}
}
if(isset($_POST['removePic'])){
	if(strpos($user->photo, '../uploads') === 0){
		unlink($user->photo);
		rmdir("../uploads/users/{$user->id}");
	}
	databaseController::getDB()->update('vartotojas', array('Nuotrauka' => '../resources/default/user/default.png'), array('ID', '=', $user->id));
	$success[] ='Profilio nuotrauka išimta';
	$user = User::current_user();
}

if(isset($_POST['editProfile'])){
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$adress = $_POST['adress'];
	$description = $_POST['description'];
	databaseController::getDB()->update('vartotojas', array(
		'Vardas' => $name,
		'Pavarde' => $surname,
		'Adresas' => $adress,
		'Aprasymas' => $description)
	, array('ID', '=', $user->id));
	$success[] ='Profilio informacija pakeista';
	$user = User::current_user();
}

if(isset($_POST['changePassword'])){
	if($user->matchPassword($_POST['oldPassword'])){
		$validator = new Validation();
		$validator->passwordChangeValidation($_POST);
		$errors = $validator->getErrors();
		if(empty($errors)){
			databaseController::getDB()->update('vartotojas', array('Slaptazodis' => password_hash($_POST['newPassword'], PASSWORD_DEFAULT)), array('ID', '=', $user->id));	
			$success[] ='Slaptažodis pakeistas';
		}
	}else{
		$errors[]='Netisingas dabartinis slaptažodis';
	}

}
?>

<div class='row'>
<div class="panel panel-success">
		<div class="panel-heading"><h3 class="panel-title"><?php echo $user->nick ?></h3></div>
	<div>
		<?php foreach($errors as $error){
			echo "<font size='2' color='red'>{$error}</font><br>";
		}
		foreach($success as $s){
			echo "<font size='2' color='green'>{$s}</font><br>";
		}
		?>
	</div>
	<div class="col-xs-4" style = "padding-top: 15px;">
		<div class = 'profilePicture'>
			<img class ="img-thumbnail" src=<?php echo $user->photo; ?>>
		</div><br>	
		<button class="btn btn-success btn-block" id="editProfilePic" data-toggle="modal" data-target="#changePic">Keisti profilio nuotrauką</button>
		<form onsubmit="return confirm('Ar tikrai norite pašalinti profilio nuotrauką?');" name="form" action="" method="post" style = 'padding-top: 5px; padding-bottom: 5px;'>
			<button type ='submit' class="btn btn-success btn-block" name="removePic" >Pašalinti profilio nuotrauką</button>
		</form>
		<button class="btn btn-success btn-block" data-toggle="modal" data-target="#editProfile">Redaguoti profilį</button>
		<button class="btn btn-success btn-block" data-toggle="modal" data-target="#changePassword">Keisti slaptažodį</button>
	</div>
	<div class="col-xs-8 " style = "padding-top: 15px;">
		
			<table class="table" style = 'table-layout: fixed;'>
				<tbody>
					<tr>
						<td class = 'profileHeading'><strong>Vardas:</strong></td>
						<td class = 'profileContent'><?php echo $user->name; ?></td>
					</tr>
					<tr>
						<td class = 'profileHeading'><strong>Pavardė:</strong></td>
						<td class = 'profileContent'><?php echo $user->surname; ?></td>
					</tr>
					<tr>
						<td class = 'profileHeading'><strong>Adresas:</strong></td>
						<td class = 'profileContent'><?php echo $user->adress; ?></td>
					</tr>
					<tr>
						<td class = 'profileHeading'><strong>Aprašymas:</strong></td>
						<td class='descriptionCell'><?php echo $user->description; ?></td>
					</tr>
					<tr>
						<td class = 'profileHeading'><strong>El. paštas:</strong></td>
						<td class = 'profileContent'><?php echo $user->email; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div id ="changePic" class="modal fade">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Profilio nuotrauko keitimas</h4>
        		<form method="post" accept-charset="UTF-8" class="form-inline" role="form" enctype="multipart/form-data">
      				<div class="modal-body">
      				<fieldset>
      						<input name="profilePic[]" type="file" accept="image/*" >
      				</fieldset>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        				<button type="submit" name="changePic" class="btn btn-primary">Redaguoti</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
      </div>
  <div id ="editProfile" class="modal fade">
  	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Profilio informaijos redagavimas</h4>
        		<form method="post" accept-charset="UTF-8" role="form">
      				<div class="modal-body">
      				<fieldset>
      					<div class = 'form-group'>
      						<input class='form-control' type = 'text' name = 'name' placeholder = 'Vardas' value = '<?php echo $user->name ?>'>
      					</div>
      					<div class = 'form-group'>
      						<input class='form-control' type = 'text' name = 'surname' placeholder = 'Pavardė' value = '<?php echo $user->surname ?>'>
      					</div>
      					<div class = 'form-group'>
      						<input class='form-control' type = 'text' name = 'adress' placeholder = 'Adresas' value = '<?php echo $user->adress ?>'>
      					</div>
      					<div class = 'form-group'>
      						<textarea class='form-control' type = 'text' name = 'description' placeholder = 'Aprasymas' style = "resize:vertical;"><?php echo $user->description ?></textarea>
						</div>
      				</div>
      				</fieldset>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        				<button type="submit" name="editProfile" class="btn btn-primary">Redaguoti</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
  </div>
    <div id ="changePassword" class="modal fade">
  	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Profilio informaijos redagavimas</h4>
        		<form method="post" accept-charset="UTF-8" role="form">
      				<div class="modal-body">
      				<fieldset>
      					<div class = 'form-group'>
      						<input class='form-control' type = 'password' name = 'oldPassword' placeholder = 'Dabartinis slaptažodis'>
      					</div>
      					<div class = 'form-group'>
      						<input class='form-control' type = 'password' name = 'newPassword' placeholder = 'Naujas slaptažodis'>
      					</div>
      					<div class = 'form-group'>
      						<input class='form-control' type = 'password' name = 'newPasswordAgain' placeholder = 'Pakartoto naują slaptažodį'>
      					</div>
      				</div>
      				</fieldset>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        				<button type="submit" name="changePassword" class="btn btn-primary">Redaguoti</button>
      				</div>
      			</form>
      		</div>
      	</div>
      </div>
  </div>
</div>

