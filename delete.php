<html>
<head>
</head>
<body>
	<?php
//including the database connection file
	include_once("database.php");
	//lese Hotel ID
	$id = $_POST['id'];
	
	//lösche Hotel, wenn Hotel ID gesetzt
	if(isset($_POST['Submit'])) { 
		try{

    		// set the PDO error mode to exception
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$id = $_POST['id'];

			$sql = "DELETE FROM bild WHERE hotel_id='$id'";
			$dbh->exec($sql);

			$sql = "DELETE FROM ausstattung WHERE hotel_id='$id'";
			$dbh->exec($sql);

			$sql = "DELETE FROM hotel WHERE id='$id'";
			$dbh->exec($sql);

			//display success message
			echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='index.php'>View Result</a>";
		}

		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}

	}
	?>
</body>
</html>
