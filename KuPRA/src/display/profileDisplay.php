<?php
include_once 'core/init.php';
$user = User::current_user();
?>

<div class='row'>
	<div class="col-xs-4">
		<div class = 'profilePicture'>
			<img class ="img-thumbnail" src=<?php echo $user->photo; ?>>
		</div><br>
		<button class="btn btn-success btn-block" id="editProfilePic">Keisti profilio nuotrauką</button>	
		<button class="btn btn-success btn-block" id="editProfile">Redaguoti profilį</button>
	</div>
	<div class="col-xs-8">
		<div class="panel panel-success">
			<div class="panel-heading"><h3 class="panel-title"><?php echo $user->nick ?></h3></div>
			<table class="table">
				<tbody>
					<tr>
						<td><strong>Vardas:</strong></td>
						<td><?php echo $user->name; ?></td>
					</tr>
					<tr>
						<td><strong>Pavardė:</strong></td>
						<td><?php echo $user->surname; ?></td>
					</tr>
					<tr>
						<td><strong>Adresas:</strong></td>
						<td><?php echo $user->adress; ?></td>
					</tr>
					<tr>
						<td><strong>Aprašymas:</strong></td>
						<td><?php echo $user->description; ?></td>
					</tr>
					<tr>
						<td><strong>El. paštas:</strong></td>
						<td><?php echo $user->email; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

