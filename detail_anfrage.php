<!DOCTYPE html>
<html>
<?php
//Verbinde Datenbank
require('database.php');
try {
	//lese Hotel ID für die Anzeige der Detailseite aus, ansonsten wirf einen Fehler
	if (!isset($_GET['id'])) {
		throw new Exception('Failure');
	}
	// lese Hotel aus der Datenbank aus
	$sth = $dbh->prepare('SELECT * from hotel where id = ?');
	$sth->execute(array($_GET['id']));
	$hotel = $sth->fetch();
	?>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="includes/style.css" type="text/css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
		// zeige Header an
		include('header.php'); ?>

		<div class="container" >
			<!-- zeige Hotelnamen an -->
			<div class="jumbotron" id="focus">
				<h1 class="text-center"><?php echo $hotel['name']; ?></h1>
			</div>

			<!-- zeige Navigationsbar an -->
			<div class="container-fluid tabStrip" >
				<ul class="nav nav-tabs text-center" >
					<li class="col-sm-3 blue"><a href="detail.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-home fa-3x col-sm-12"></i><span class="col-sm-12">Detail</span></a></li>
					<li class="col-sm-3 grey"><a href="detail_region.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-globe fa-3x col-sm-12"></i><span class="col-sm-12">Region</span></a></li>
					<li class="col-sm-3 blue"><a href="detail_anfrage.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-envelope-o fa-3x col-sm-12"></i><span class="col-sm-12">Anfrage</span></a></li>
					<li class="col-sm-3 grey"><a href="detail_karte.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-map-o fa-3x col-sm-12"></i><span class="col-sm-12">Karte</span></a></li>
				</ul>

			</div>

			<div class="row">
				
				<!-- zeige Kontaktformular an -->
				<div class="col-md-3">
					<h2>Kontaktanfrage</h2>
					<form action="mailto:deine@adresse.de" method="post" name="Formular" enctype="text/plain" onsubmit="return validateForm()">
						<span>Absender: </span>
						<br>
						<input type="text" name="absender" size="34">
						<br>
						<br>
						<span>Nachricht: </span>
						<br>
						<textarea name="nachricht" rows="3" cols="25"></textarea>
						<br>
						<br>
						<input class="submit" type="submit" value="Abschicken">
					</form>
				</div>
			</div>
			
			<?php
		} catch (Exception $e) {
			header("404 Not Found", true, 404);
			include("404.php");
			exit;
		}
		?>
	</div>
</body>
<!-- setze den Fokus auf den Hotelnamen (jumbatron) -->
<script>document.getElementById('focus').scrollIntoView();</script>
</html>