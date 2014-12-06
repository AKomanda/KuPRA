<?php
include_once "./class/recepie.php";
$id=$_GET['id'];
$receptas = recepie::getRecepie($id);
?>

<div class="mainContainer">
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
		
			<div id="carousel-wrapper">
				<div id="carousel">
				<?php 

				if(sizeOf ( $receptas->getPhotos ()) <= 0) {
					echo '<span id="1"><img src="../resources/default/recepie/default.png"/></span>';
				} else {
				
					for($i = 0; $i < sizeOf ( $receptas->getPhotos () ); $i ++) {
						echo '<span id="' . $i . '"><img src="' . $receptas->getPhotos ()[$i] . '" /></span>';
					}
				}
				

				?>

				</div>
			</div>
			<div id='thumbs-wrapper'>
			<div id='thumbs'>
				
				<?php 
				if (sizeOf($receptas->getPhotos()) >= 2) {
					echo "";
					for($i = 0; $i < sizeOf ( $receptas->getPhotos () ); $i ++) {
						echo '<a href="#' . $i . '" class="selected"><img src="' . $receptas->getPhotos ()[$i] . '" /></a>';
					}
					echo "";
				}
				
				?>	
				</div>
				<a id='prev' href='#'></a>
				<a id='next' href='#'></a>
				</div>		
			
		</div>

		<div class="clear"></div>
		<div class="recepieScore">
			<?php
			$out = "";
			for($i = 0; $i < round($receptas->getScore (), 0, PHP_ROUND_HALF_DOWN); $i ++) {
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
</div>

<?

?>