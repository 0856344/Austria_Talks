<html>
<head>
	<title>Add Data</title>
</head>
<body>
	<?php
  	// Turn off all error reporting
	error_reporting(0);
	?>
	<body>
		<?php
		//including the database connection file
		include_once("database.php");

		//lese die Felder für die Anlage eines neuen Hotels aus 
		if(isset($_POST['Submit'])) {    
			$name = $_POST['name'];
			$description = $_POST['description'];
			$email = $_POST['email'];
			$ort = $_POST['ort'];

			$telefon = $_POST['telefon'];
			$adresse = $_POST['adresse'];
			$anfahrt = $_POST['anfahrt'];
			$kategorie = $_POST['kategorie'];
			$bewertung = $_POST['bewertung'];

			$wlan = $_POST['wlan'];
			$sauna = $_POST['sauna'];
			$whirlpool = $whirlpool['whirlpool'];

    		// überprüfe, ob Pflichtfelder leer sind
			if(empty($name) || empty($description) || empty($email)|| empty($ort) || empty($telefon) || empty($adresse) || empty($anfahrt) || empty($kategorie) || empty($bewertung)) {                
				if(empty($name)) {
					echo "<font color='red'>Name field is empty.</font><br/>";
				}

				if(empty($description)) {
					echo "<font color='red'>description field is empty.</font><br/>";
				}


				if(empty($email)) {
					echo "<font color='red'>Email field is empty.</font><br/>";
				}
				if(empty($telefon)) {
					echo "<font color='red'>telefon field is empty.</font><br/>";
				}

				if(empty($adresse)) {
					echo "<font color='red'>adresse field is empty.</font><br/>";
				}
				if(empty($anfahrt)) {
					echo "<font color='red'>anfahrt field is empty.</font><br/>";
				}
				if(empty($kategorie)) {
					echo "<font color='red'>kategorie field is empty.</font><br/>";
				}
				if(empty($bewertung)) {
					echo "<font color='red'>bewertung field is empty.</font><br/>";
				}
				if(empty($ort)) {
					echo "<font color='red'>ort field is empty.</font><br/>";
				}



        //link to the previous page
				echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
			} else { 
        		// if all the fields are filled (not empty)             
        		//insert data to database
				try{
					//füge Hotel in Datenbank ein
    				// set the PDO error mode to exception
					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = "INSERT INTO hotel (id, name, description,email,ort_id,telefon,adresse,anfahrtsbeschreibung,kategorie,bewertung) VALUES ('$name','$name','$description','$email',$ort,'$telefon','$adresse','$anfahrt',$kategorie,$bewertung)";
					$dbh->exec($sql);

					// füge Hotel Ausstattung in Datenbank ein
					if(!empty($sauna)) {
						$sql = "INSERT INTO ausstattung (id, description,hotel_id) VALUES (NULL,'$sauna','$name')";
						$dbh->exec($sql);
					}

					if(!empty($wlan)) {
						$sql = "INSERT INTO ausstattung (id, description,hotel_id) VALUES (NULL,'$wlan','$name')";
						$dbh->exec($sql);
					}

					if(!empty($whirlpool)) {
						$sql = "INSERT INTO ausstattung (id, description,hotel_id) VALUES (NULL,'$whirlpool','$name')";
						$dbh->exec($sql);
					}


       		 //display success message
					echo "<font color='green'>Data added successfully.";
					echo "<br/><a href='index.php'>View Result</a>";
				}
				catch(PDOException $e)
				{
					echo $sql . "<br>" . $e->getMessage();
				}
			}
		}
		?>
	</body>
	</html>
