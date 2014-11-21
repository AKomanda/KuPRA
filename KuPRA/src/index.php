<!DOCTYPE html>
<html>
<head>
<!-- <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>  -->
<link rel="stylesheet" type="text/css" href="styles/recepieDisplay.css">
<!-- jQuery library (served from Google) -->
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="styles/jquery.carouFredSel-6.0.4-packed.js"></script>
<script type="text/javascript">
			$(function() {
				
				$('#carousel span').append('<img src="styles/img/gui/carousel_glare.png" class="glare" />');
				$('#thumbs a').append('<img src="styles/img/gui/carousel_glare_small.png" class="glare" />');

				$('#carousel').carouFredSel({
					responsive: true,
					circular: false,
					auto: false,
					items: {
						visible: 1,
						width: 250,
						height: '70%'
					},
					scroll: {
						fx: 'directscroll'
					}
				});

				$('#thumbs').carouFredSel({
					responsive: true,
					circular: true,
					infinite: false,
					auto: false,
					prev: '#prev',
					next: '#next',
					items: {
						visible: {
							min: 2,
							max: 6
						},
						height: '66%'
					}
				});

				$('#thumbs a').click(function() {
					$('#carousel').trigger('slideTo', '#' + this.href.split('#').pop() );
					$('#thumbs a').removeClass('selected');
					$(this).addClass('selected');
					return false;
				});

			});
		</script>
<style type="text/css">

</style>
</head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<?php
include_once "display/recepieDisplay.php";
include_once "class/databaseController.php";
databaseController::getDB ();
?>
</body>

</html>