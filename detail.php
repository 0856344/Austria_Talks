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
	$hotel_id = $hotel['id'];
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

		
		<div class="container" id="focus"  >
			<!-- zeige Hotelnamen an & setzte Fokus -->
			<div class="jumbotron">
				<h1 class="text-center"><?php echo $hotel['id']; ?></h1>
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
			<div class="row" >
				<!-- binde Slideshow ein -->
				<?php
				include('slider.php');
				?>
				
			</div>
			<div class="row">
				<!-- zeige Überschrift "Steckbrief" an -->
				<div class="col-md-12">
					<h1 style = "background-color:lightgrey">Steckbrief</h1>
					<br>
				</div>
			</div>
			<div class="row">
				<!-- zeige Beschreibung & Anfahrtsbeschreibung an -->
				<div class="col-md-8">
					<p style = "background-color:powderblue; font-size: 24px;"><?php echo $hotel['description']; ?> </p>
					<h3 style = "background-color:lightgrey">Anfahrtsbeschreibung</h3>
					<p style = "background-color:powderblue; font-size: 24px;"><?php echo $hotel['anfahrtsbeschreibung']; ?> </p>
				</div>
				<div class="col-md-4">

					<!-- zeige Telefon/Adresse/Kategorie/Bewertung an -->
					<table class="table table-striped">
						<tr><td><p style = " font-size: 24px;">Telefon: <?php echo $hotel['telefon']; ?> </p></td></tr>
						<tr><td><p style = " font-size: 24px;">Adresse: <?php echo $hotel['adresse']; ?> </p></td></tr>
						<tr><td><p style = " font-size: 24px;">Kategorie: <?php echo $hotel['kategorie']; ?> </p></td></tr>
						<tr><td><p style = " font-size: 24px;">Bewertung: <?php echo $hotel['bewertung']; ?> </p></td></tr>

						<!-- zeige Ausstattung inkl. Glyphicons an -->
						<?php
						foreach ($dbh->query("SELECT * from ausstattung WHERE hotel_id='$hotel_id'") as $ausstattung) {?>
						<tr><td> <p style = " font-size: 24px;"> <?php echo $ausstattung['description']; ?> <span class="glyphicon glyphicon-ok"></span></p> </tr></tr>
							<?php } ?>
					</table>
				</div>
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