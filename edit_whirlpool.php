<html>
<head>
	<title>Admin</title>
</head>

<body>

	<?php
	//verbinde Datenbank
	include_once("database.php");
	//lese Pflichtfelder und überprüfe ob Werte gesetzt wurden
	if(isset($_POST['Submit'])) {    
		$whirlpool = $_POST['whirlpool'];
		$hotel_id = $_POST['name'];
            
			//insert data to database
		try{
				// set the PDO error mode to exception
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// Wenn whirlpool auf unchecked gesetzt wurde, dann lösche den Eintrag
			if(empty($whirlpool)) {
				$sql = "DELETE FROM ausstattung WHERE hotel_id='$hotel_id' AND description='whirlpool'";
				$dbh->exec($sql);
				echo "<font color='green'>Data deleted successfully.";
				echo "<br/><a href='index.php'>View Result</a>";
			}else{
				// Wenn whirlpool auf checked gesetzt wurde, dann erstelle Eintrag
				$sql = "INSERT INTO ausstattung (id, description,hotel_id) VALUES (NULL,'$whirlpool','$hotel_id')";
					$dbh->exec($sql);
				echo "<font color='green'>Data added successfully.";
				echo "<br/><a href='index.php'>View Result</a>";
			}
				// use exec() because no results are returned
	
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
	}

?>

</body>
</html>