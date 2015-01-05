<?php
$perPage = 20;
if(isset($_GET['page'])){
	if($_GET['page'] > 1){
		$page = $_GET['page'];
		$offset = ($page - 1) * $perPage;
	}else{
		$page = 1;
		$offset = 0;
	}
}else{
	$page = 1;
	$offset = 0;
}
	$allusers = databaseController::getDB()->get('vartotojas', array())->results();
	
	$recordCount = count($allusers);
	if($recordCount > $offset){
		$users = array_slice($allusers, $offset, $perPage);
	}else{
		$users = array();
	}
?>
<table class="table table-boarded table-stripped" style = 'text-align: center;'>
	<thead>
		<th style = 'text-align: center;'>Vartotojo Slapyvardis</th>
	</thead>
	<tbody>
		<?php  foreach($users as $user){?>
			<tr class="listItemContainer">
				<td><a href='user.php?id=<?php echo $user->ID?>'><?php echo $user->Slapyvardis ?></a></td>
			</tr>
		<?php }?>
	</tbody>
</table>
<div class = 'row'>
			<div class = 'col-xs-12'>
				<p style="text-align:center;">
					<?php if($offset > 0){
						$prevPage = $page - 1;
						echo "<a href = 'users.php?page={$prevPage}'><span class='glyphicon glyphicon-arrow-left'></a>";
					}
					if($offset > 0 || $recordCount > $offset + $perPage){
						echo $page;
					}
					
					if($recordCount > $offset + $perPage){
						$secondPage = $page +1;
						echo "<a href = 'users.php?page={$secondPage}'><span class='glyphicon glyphicon-arrow-right'></a>"; 
					}
					?>
				</p>
			</div>
		</div>