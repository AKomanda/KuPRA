<?php
include_once "./class/recepie.php";
$receptas = new recepie ();
?>

<div class="recepieContainer">
	<div class="recepieTop">
		<div class="recepieName">
		<?php echo $receptas->getName()?>
		</div>
		<div class="recepieAuthor">
		<?php echo $receptas->getAuthor()?>
		</div>
		<div class="recepieTypes">
		<?php
		
		for($i = 0; $i < sizeOf ( $receptas->getType () ); $i ++) {
			echo $receptas->getType ()[$i];
		}
		?>
		</div>
	</div>
	<div class="recepieTopInfo">
		<div class="recepieTimeToMake">
		<?php 
			echo $receptas->getTimeToMake();
		?>
		</div>
		<div class="recepiePortionCount">
		<?php 
			echo $receptas->getPortionCount();
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
			
			for($i = 0; $i < sizeOf ( $receptas->getPhotos () ); $i ++) {
				echo $receptas->getPhotos ()[$i];
			}
			?>
			</div>
			<div class="clear"/>
		<div class="recepieScore">
			<?php
			echo $receptas->getScore ();
			?>
			</div>
	</div>
	<div class="clear"/>
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