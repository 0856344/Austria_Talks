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
		<!-- binde Google Maps API ein-->
		<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<!--magic-->
		<script>
			var geocoder;
			var map;
			var mapOptions = {
				zoom: 17,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var marker;
			function initialize() {
				geocoder = new google.maps.Geocoder();
				map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
				codeAddress();
			}
			function codeAddress() {
				var address = document.getElementById('address').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						if(marker)
							marker.setMap(null);
						marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location,
							draggable: true
						});
						google.maps.event.addListener(marker, "dragend", function() {
							document.getElementById('lat').value = marker.getPosition().lat();
							document.getElementById('lng').value = marker.getPosition().lng();
						});
						document.getElementById('lat').value = marker.getPosition().lat();
						document.getElementById('lng').value = marker.getPosition().lng();
					} else {
						alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}
		</script>

	</head>
	<body onload="initialize()">
		


		<?php 
		//zeige Header an
		include('header.php'); ?>

		

		<div class="container" >
			<!-- zeige Hotelnamen an & setzte Fokus -->
			<div class="jumbotron" id="focus">
				<h1 class="text-center"><?php echo $hotel['id']; ?></h1>
			</div>		
		</div>
		<!-- zeige Navigationsbar an -->
		<div class="container-fluid tabStrip" style="width:60%">
			<ul class="nav nav-tabs text-center" >
				<li class="col-sm-3 blue"><a href="detail.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-home fa-3x col-sm-12"></i><span class="col-sm-12">Detail</span></a></li>
				<li class="col-sm-3 grey"><a href="detail_region.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-globe fa-3x col-sm-12"></i><span class="col-sm-12">Region</span></a></li>
				<li class="col-sm-3 blue"><a href="detail_anfrage.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-envelope-o fa-3x col-sm-12"></i><span class="col-sm-12">Anfrage</span></a></li>
				<li class="col-sm-3 grey"><a href="detail_karte.php?id=<?php echo $hotel['id']; ?>"><i class="fa fa-map-o fa-3x col-sm-12"></i><span class="col-sm-12">Karte</span></a></li>
			</ul>

		</div>
		<div>
			<!-- suche nach der Hotel Adresse  -->
			<input id="address" type="hidden" style="width:60%" value="<?php echo $hotel['adresse']; ?>">
			
			<input type="hidden" id="lat"/>
			<input type="hidden" id="lng"/>
		</div>
		
		<div id="map_canvas" style="height:90%;top:30px"></div>

		
		
		<?php
	} catch (Exception $e) {
		header("404 Not Found", true, 404);
		include("404.php");
		exit;
	}
	?>
</div>
</body>

<!-- stelle Google Maps API Key zu Verfügung -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVELJbOBC87QYXPsY5cY0buxfJgU9er8Q&callback=initMap"
type="text/javascript"></script>

<!-- setze den Fokus auf den Hotelnamen (jumbatron) -->
<script>document.getElementById('focus').scrollIntoView();</script>
</html>