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

	// lese den zugehörigen Ort aus der Datenbank aus
	$ort_id = $hotel['ort_id'];
	$sth = $dbh->prepare("SELECT * from ort where id = :ort_id");
	$sth->execute(array(':ort_id' => $ort_id));
	$ort = $sth->fetch();
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
			<!-- zeige Hotelnamen an & setzte Fokus -->
			<div class="jumbotron" id="focus">
				<h1 class="text-center"><?php echo $ort['name']; ?></h1>
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
				<!-- zeige Ort Bild an -->
				<br>
				<br>
				<div class="col-md-6">
					<?php
					echo '<img src="data:image/jpeg;base64,'.base64_encode( $ort['Bild'] ).'" width=500/>';
					?>
				</div>
				

				<div class="col-md-6">
					<!-- zeige Ort Informationen an -->
					<h1> <?php echo $ort['name']; ?> im Detail</h1>
					<br>
					<p>Seehöhe: <?php echo $ort['seehoehe']; ?></p>
					<p>Einwohner: <?php echo $ort['einwohner']; ?></p>
					<p>Aktivitäten</p>
					<p><?php echo $ort['aktivitaeten']; ?></p>
					
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