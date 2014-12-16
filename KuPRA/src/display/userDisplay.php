<?php
include_once 'core/init.php';
$id = $_GET['id'];
if($id == User::current_user()->id){
	header('Location: profile.php');
}
$user = User::getUser($id);
if($user == false){
	header('Location: index.php');
}

?>

<div class='row'>
	<div class="panel panel-success">
		<div class="panel-heading"><h3 class="panel-title"><?php echo $user->nick ?></h3></div>
		<div class="col-xs-4" style = "padding-top: 15px;">
			<div class = 'profilePicture'>
				<img class ="img-thumbnail" src=<?php echo $user->photo; ?>>
			</div><br>
		</div>
		<div class="col-xs-8" style = "padding-top: 15px;">
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
</div>