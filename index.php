<?php
//Verbinde Datenbank
require('database.php');

//Funtion zum kürzen den Beschreibung für die Vorschau
function excerpt($content, $maxchars) {
	// truncate string
	$content = substr($content, 0, $maxchars);
	// last occurrence of " "
	$pos = strrpos($content, " ");
	if ($pos>0) {
		// truncate string again
		$content = substr($content, 0, $pos);
	}
	// append "..."
	return $content."...";

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hotelzimmer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href="includes/style.css" type="text/css" rel="stylesheet">
	<script src="includes/script.js" type="text/javascript"></script>
</head>

<body>

	<?php
	// Turn off all error reporting 
	error_reporting(0);
	?>

	<?php 
	// zeige Header an
	include('header.php'); ?>

	<div class="container" >
		<div class="row">
			<div class=" col-md-3">
				<!-- Filter Section -->
				<h2> Filter </h2>
				<!-- SQL Datenbankaufruf ohne Filter & Suche-->
				<?php $sql = 'SELECT * from hotel';?>

				<table class="table table-striped">
					<!-- zeige Filtermöglichkeiten an-->
					<form id="filter" action="" method="post" name="filter">
						<tr>
							<tr><td>min. Kategorie</td><td><input id="kategorie" name="kategorie" type="number" class="" min="1" max="5" step="1" value="<?php echo htmlspecialchars($_POST['kategorie']); ?>"  ></td></tr>
							<tr><td>min. Bewertung</td><td><input id="bewertung" name="bewertung" type="number" class="" min="1" max="5" step="1" value="<?php echo htmlspecialchars($_POST['bewertung']); ?>"></td></tr>
							<tr><td>WLan</td><td><input id="wlan" type="checkbox" name="wlan" value="wlan" <?php if(isset($_POST['wlan'])) echo "checked='checked'"; ?> ></td></tr>
							<tr><td>Sauna</td><td><input id="sauna" type="checkbox" name="sauna" value="wlan" <?php if(isset($_POST['sauna'])) echo "checked='checked'"; ?> ></td></tr>
							<tr><td>Whirlpool</td><td><input id="whirlpool" type="checkbox" name="whirlpool" value="wlan" <?php if(isset($_POST['whirlpool'])) echo "checked='checked'"; ?> ></td></tr>

							<tr><td>Sortierung</td><td> 
								<select  id="sort" name = "sort">
									<option>Name</option>
									<option>Kategorie: höchste zuerst</option>
									<option>Bewertung: höchste zuerst</option>
								</select>
							</td></tr>
							<script type="text/javascript">
								document.getElementById('sort').value = "<?php echo $_POST['sort'];?>";
							</script>
							<tr><td></td><td><input type="submit" name="Submit" value="suche"></td></tr>
						</tr>
					</form>
				</table>

			</div>

			<div class=" col-md-9">
				<table class="table table-striped">
				<?php   
				// lese gesetzte Filter & Sortierung und erstelle das passende SQL Statement 
				if(isset($_POST['Submit'])){ //check if form was submitted
					$wlan = $_POST['wlan']; 
					$sauna = $_POST['sauna']; 
					$whirlpool = $_POST['whirlpool']; 
					$kategorie = $_POST['kategorie']; 
					$bewertung = $_POST['bewertung']; 
					$sort = $_POST['sort']; 

					//wenn Ausstattungsfilter gesetzt wurden, dann beginne hier mit der Erstellung des SQL Statements
					if (!empty($wlan)||!empty($sauna)||!empty($whirlpool)){

						$sql = "SELECT DISTINCT hotel.id, hotel.name, hotel.description FROM hotel WHERE hotel.id = hotel.id "; 
						if (!empty($wlan)){

							$sql_wlan = "AND EXISTS (SELECT * FROM ausstattung WHERE hotel_id = hotel.id AND ausstattung.description = 'wlan') ";
							$sql = $sql . $sql_wlan;

						}
						if (!empty($sauna)){
							$sql_sauna = "AND EXISTS (SELECT * FROM ausstattung WHERE hotel_id = hotel.id AND ausstattung.description = 'sauna') ";
							$sql = $sql . $sql_sauna;
						}
						if (!empty($whirlpool)){
							$sql_whirlpool = "AND EXISTS (SELECT * FROM ausstattung WHERE hotel_id = hotel.id AND ausstattung.description = 'whirlpool') ";
							$sql = $sql . $sql_whirlpool;
						}
						if (!empty($kategorie)){
							$sql_kategorie = "AND hotel.kategorie>$kategorie ";
							$sql = $sql . $sql_kategorie;
						}
						if (!empty($bewertung)){
							$sql_bewertung = "AND hotel.bewertung>$bewertung ";
							$sql = $sql . $sql_bewertung;
						}
						if (!empty($sort)){
							if (strcmp($sort,"Kategorie: höchste zuerst")==0){
								$sql_sort = "ORDER BY hotel.kategorie DESC";
								$sql = $sql . $sql_sort;
							}else

							if (strcmp($sort,"Bewertung: höchste zuerst")==0){

								$sql_sort = "ORDER BY hotel.bewertung DESC";
								$sql = $sql . $sql_sort;
							}
							if (strcmp($sort,"Name")==0){
								$sql_sort = "ORDER BY hotel.name ASC";
								$sql = $sql . $sql_sort;
							}
						}
						echo $sql;

					// wenn keine Ausstattungs Filter gesetzt wurden, dann beginne hier mit der Erstellung des SQL Statements
					}else{
						
						$sql = 'SELECT * FROM hotel WHERE id = id ';
						if (!empty($kategorie)){
							$sql_kategorie = "AND hotel.kategorie>=$kategorie ";
							$sql = $sql . $sql_kategorie;
						}
						if (!empty($bewertung)){
							$sql_bewertung = "AND hotel.bewertung>=$bewertung ";
							$sql = $sql . $sql_bewertung;
						}

						if (!empty($sort)){
							if (strcmp($sort,"Kategorie: höchste zuerst")==0){
								$sql_sort = "ORDER BY hotel.kategorie DESC";
								$sql = $sql . $sql_sort;
							}else
							if (strcmp($sort,"Bewertung: höchste zuerst")==0){
								$sql_sort = "ORDER BY hotel.bewertung DESC";
								$sql = $sql . $sql_sort;
							}
							if (strcmp($sort,"Name")==0){
								$sql_sort = "ORDER BY hotel.name ASC;";
								$sql = $sql . $sql_sort;
							}
						}


					}
				}
				?>
				<?php

				//zeige die gefilterte und sortierte Hotelliste an (Name, Beschreibung & Bild)
				foreach ($dbh->query($sql) as $hotel) {

					?>
					<tr>
						<td>
							<?php
							$hotel_id = $hotel['id'];
							$sql = $dbh->prepare("select * from bild where hotel_id = :hotel_id");
							$sql->execute(array(':hotel_id' => $hotel_id));
							$row = $sql->fetch(PDO::FETCH_ASSOC);
							echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'" width=250/>';
							?>

						</td>
						<td>
							<h4><?php echo $hotel['name']; ?></h4>
							<p>
								<?php echo excerpt($hotel['description'],150); ?>
								<br>
								<a href="detail.php?id=<?php echo $hotel['id']; ?>">mehr</a></p>
							</td>		
						</tr>
						<?php
					}
					?> 
				</table>		
			</div>


		</div>
	</div>
	<!-- Link zum Admin Bereich -->
	<div class="col-md-1 offset-md-11">
		<p id="Admin"> <a href="Admin.php">Admin</a></p>
	</div>

</body>




</html>

