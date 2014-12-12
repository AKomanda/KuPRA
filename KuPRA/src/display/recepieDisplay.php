<?php
include_once 'core/init.php';
$id = $_GET ['id'];
$missingProducts = array();
$receptas = recepie::getRecepie ($id);
$alreadyMade = false;
if (isset($_GET['m'])) {
	$fromMenu = $_GET['m'];
	$alreadyMade =  $receptas->isMadeByUser(user::current_user()->id, $fromMenu);
}
if (empty($missingProducts = fridge::searchMissing(user::current_user()->id, recepie::getRequiredProducts($id)))) {
	$notEnoughProducts = false;
} else {
	$notEnoughProducts = true;
}

if ($_POST) {
	$error = false;
	if (((isset($_POST['portion'])) && (isset($_POST['date']))) || (isset($_POST['prepareSubmit']))) {
		if (isset($_POST['portion'])) {
			$portion = $_POST['portion'];
			if (!ctype_digit($portion)) {
				$error = true;
			}
		}
		if (isset($_POST['date'])) {
			$date = $_POST['date'];
		}
		
		
		if(!$error) {
			if ((isset ( $_POST ['prepare'] ) || (isset($_POST['prepareSubmit'])))) {
				$prepare = true;
			} else {
				$prepare = false;
			}
			if (!isset($_POST['prepareSubmit'])) {
				meniu::addNewRecepie(user::current_user()->id, $id, $date, $portion);	
			}
			if ($prepare) {
				if (isset($_POST['prepareSubmit'])) {
					$insertionId = $_GET['m'];
				} else {
					$insertionId = databaseController::getDB()->getLast();
				}
				recepie::prepareRecepie($insertionId);
			}
			header("location: mymeniu.php");
					
		}
		
	}
	
}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
				<div class="col-xs-12 col-sm-6">
					<h2><?php echo $receptas->getName(); ?></h2>
                    <p>sukūrė <strong><?php echo $receptas->getAuthor(); ?></strong></p>
                    <p>
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
                    </p>
                    
                    <p>
                    	<?php
							$out = "";
							$out .= "<table class='table table-striped'>";
							$out .= "<thead>";
							$out .= "<tr>";
							$out .= "<td>Produktas</td>";
							$out .= "<td>Kiekis</td>";
							$out .= "<td>Matavimo vienetas</td>";
							$out .= "<tbody>";
							
							
							foreach ( $receptas->getProducts () as $key => $element ) {
							$out .= "<tr>";
								foreach ( $element as $subkey => $subelement ) {
									if ($subkey != 'Receptas') {
										if ($subkey == 'Produktas') {
											$out .= "<td style='width: 75%'>$subelement</td>";
										} else {
											$out .= "<td>$subelement</td>";
										}
									}
								}
							$out .= "</tr>";
							}
							$out .= "</tbody>";
							$out .= "</table>";
							echo $out;
						?>
                    </p>
                    
				</div>
				<div class="col-xs-12 col-sm-6" style="margin-top: 35px;">
					<p class="text-right">
					<?php 
					
					foreach ($receptas->getType() as $tipas) {
						
						echo " $tipas ";
					}
					
					?>
					
					</p>
                    <figure>
                        
                        <div class="recepiePhotos">

						<div id="carousel-wrapper">
						<div id="carousel">
							<?php
				
							if (sizeOf ( $receptas->getPhotos () ) <= 0) {
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
				if (sizeOf ( $receptas->getPhotos () ) >= 2) {
					echo "";
					for($i = 0; $i < sizeOf ( $receptas->getPhotos () ); $i ++) {
						echo '<a href="#' . $i . '" class="selected"><img src="' . $receptas->getPhotos ()[$i] . '" /></a>';
					}
					echo "";
				}
				
				?>	
				</div>
			<a id='prev' href='#'></a> <a id='next' href='#'></a>
		</div>

	</div>
	<input id="rating" type="number" class="rating" >
                    </figure>
                    
                </div>			
			</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-body">
				<p class="text-justiy"><?php echo $receptas->getDescription(); ?> </p>
			</div>
			</div>
		</div>
	</div>
	<!-- Gaminti  -->
	<?php if (!$alreadyMade) { ?>
	<div class="row">
	<div class="col-md-10"></div>
	<div class="col-md-1">
		<?php if(!isset($_GET['m'])) { ?>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal">Pridėti į valgiaraštį</button>
		<?php  } else { 
			if ($notEnoughProducts) {
			?>
			<button type="button" class="btn btn-default" data-toggle="modal" data-target=".modal">Ko man trūksta?</button>
			<?php } else {?>
		<form method="post" accept-charset="UTF-8" class="form-inline" role="form">
		<button type="submit" name="prepareSubmit" class="btn btn-primary">Gaminti</button>
		</form>
		<?php }
		} ?>
	</div>
	</div>
<!-- 	Trukstami produktai -->
	<?php if ($notEnoughProducts) { ?>
		<div class="modal fade">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        				<h4 class="modal-title">Ko man trūksta?</h4>
      				</div>
      					<div class="modal-body">
      					<?php
      					$out = "";
      					$out .= "<table class='table table-striped'>";
      					foreach ($missingProducts as $missing) {
      						$out .= "<tr>";
      						$out .= "<td>" . product::getProductNameById($missing[0]) . "</td>";
      						$out .= "<td>" . $missing[1] . "</td>";
      						$out .= "<td>" . measure::getMeasureNameById($missing[2]) . "</td>";
      						$out .= "<tr>";
      					}
      					$out .= "</table>";
      					
      					echo $out;
      					
      					?>
      					</div>
      					<div class="modal-footer">
        					<button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
      					</div>
      				</form>
    			</div><!-- /.modal-content -->
  			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<?php } else {?>
<!-- 		Pridet į valgiarasti -->
		<div class="modal fade">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        				<h4 class="modal-title">Pridėti į valgiaraštį</h4>
      				</div>
      				<form method="post" accept-charset="UTF-8" class="form-inline" role="form">
      					<form method="post" accept-charset="UTF-8" class="form-inline" role="form">
      					<div class="modal-body">
      					<fieldset>
      						<div class="form-group">
      							<input class="form-control" value="" placeholder="Porcijų skaičius" name="portion" type="number" min="1">
      							<input class="form-control" value="" placeholder="Data: YYYY-MM-DD" name="date" type="text">
      						</div>
      					</fieldset>
      					</div>
      				
      					<div class="modal-footer">
        					<button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
        					Gaminti? &nbsp;<input name="prepare" type="checkbox" />
        					<button type="submit" name="addToMenu" class="btn btn-primary">Pridėti į valgiaraštį</button>
      					</div>
      					</form>
      				</form>
    			</div><!-- /.modal-content -->
  			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<?php }
		} ?>
</div>