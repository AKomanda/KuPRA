<?php
  include_once '../class/databaseController.php';
if ($_POST) {
	$q = $_POST ['search'];
	$qb = "%" . $q . "%";
	$auth = databaseController::getDB ()->get ( "maisto_produktai", array (
			"Pavadinimas",
			"like",
			$qb 
	) )->results ();
	foreach ( $auth as $words ) {
		$word = $words->Pavadinimas;
		$bold_word = '<strong>' . $q . '</strong>';
		$final_word = str_ireplace ($q, $bold_word, $word);
		?>
<div id='show' class="container-fluid">
	<span class="name"><?php echo $word; ?></span>
</div>
<?php
	}
}
?>