<?php
include_once "./class/recepie.php";
$receptas = recepie::getRecepie(1);
?>

<div class="recepieContainer">
	<div class="recepieTop">
		<div class="recepieName">
		<?php echo "<h1>" . $receptas->getName()."</h1>"?>
		</div>
		<div class="recepieBy">by</div>
		<div class="recepieAuthor">
		<?php echo $receptas->getAuthor()?>
		</div>
		<div class="recepieTypes">
		<?php
		
		for($i = 0; $i < sizeOf ( $receptas->getType () ); $i ++) {
			echo $receptas->getType ()[$i] . ", ";
		}
		?>
		</div>
	</div>
	<div class="recepieTopInfo">
		<div class="recepiePortionCount">
			<div class="recepiePortionCountIco"></div>
		<?php
		echo $receptas->getPortionCount ();
		?>
		</div>

		<div class="recepieTimeToMake">
			<div class="recepieTimeToMakeIco"></div>
		<?php
		echo $receptas->getTimeToMake ();
		?>
		</div>
	</div>
	<div class="recepieMid">
		<div class="recepieProducts">
	<?php
	$out = "";
	$out .= "<table>";
	
	foreach ( $receptas->getProducts () as $key => $element ) {
		$out .= "<tr>";
		foreach ( $element as $subkey => $subelement ) {
			$out .= "<td>$subelement</td>";
		}
		$out .= "</tr>";
	}
	$out .= "</table>";
	echo $out;
	?>
		</div>
		<div class="recepiePhotos">
			<?php
			
			//for($i = 0; $i < sizeOf ( $receptas->getPhotos () ); $i ++) {
			//	echo $receptas->getPhotos ()[$i];
			//}
			?>
			
			<div id="carousel-wrapper">
				<div id="carousel">
					<span id="pixar"><img src="../resources/testavimoSumetimai/kotletai.jpg" /></span>
					<span id="bugs"><img src="../resources/testavimoSumetimai/kotletai2.jpeg" /></span>
					<span id="cars"><img src="../resources/testavimoSumetimai/kotletai3.jpg" /></span>
					<span id="incred"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
					<span id="monsters"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
					<span id="nemo"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
					<span id="rat"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
					<span id="toystory"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
					<span id="up"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
					<span id="walle"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></span>
				</div>
			</div>
			<div id="thumbs-wrapper">
				<div id="thumbs">
					<a href="#pixar" class="selected"><img src="../resources/testavimoSumetimai/kotletai.jpg" /></a>
					<a href="#bugs"><img src="../resources/testavimoSumetimai/kotletai2.jpeg" /></a>
					<a href="#cars"><img src="../resources/testavimoSumetimai/kotletai3.jpg" /></a>
					<a href="#incred"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></a>
					<a href="#monsters"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></a>
					<a href="#nemo"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></a>
					<a href="#rat"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></a>
					<a href="#toystory"><img src="../resources/testavimoSumetimai/kotletai4.jpg"  /></a>
					<a href="#up"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></a>
					<a href="#walle"><img src="../resources/testavimoSumetimai/kotletai4.jpg" /></a>
				</div>
				<a id="prev" href="#"></a>
				<a id="next" href="#"></a>
			</div>

		<div class="clear"></div>
		<div class="recepieScore">
			<?php
			$out = "";
			for($i = 0; $i <  $receptas->getScore (); $i ++) {
				$out .= "<div id='starFull'></div>";
			}
			for($i = 0; $i <  10-$receptas->getScore (); $i ++) {
				$out .= "<div id='starEmpty'></div>";
			}
			echo $out . " " . $receptas->getScore() ."/10";
			?>
			</div>
	</div>
	<div class="clear"></div>
	<div class="recepieBottom">
		<div class="recepieDescription">
			<?php
			echo $receptas->getDescription ();
			?>
		</div>
	</div>
</div>

<?

?>