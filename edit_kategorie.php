<html>
<head>
	<title>Add Data</title>
</head>

<body>

	<?php
	//verbinde Datenbank
	include_once("database.php");
	//lese Pflichtfelder und überprüfe ob Werte gesetzt wurden
	if(isset($_POST['Submit'])) {    
		$kategorie = $_POST['kategorie'];
		$hotel_id = $_POST['name'];

		if(empty($kategorie)) {
			echo "<font color='red'>kategorie field is empty.</font><br/>";
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}
		else { 
			// if all the fields are filled (not empty)             
			// ändere Werte in der Datenbank
			try{
				// set the PDO error mode to exception
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE hotel SET kategorie=$kategorie WHERE id='$hotel_id'";
				// use exec() because no results are returned
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
	}
	?>

</body>
</html>