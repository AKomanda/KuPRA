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
<div class="show">
	<span class="name"><?php echo $final_word; ?></span>
</div>
<?php
	}
}
?>