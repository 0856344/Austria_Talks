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
		$aktivitaeten = $_POST['aktivitaeten'];
		$id = $_POST['id'];

		if(empty($aktivitaeten)) {
			echo "<font color='red'>aktivitaeten field is empty.</font><br/>";
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}
		else { 
			// if all the fields are filled (not empty)             
			// ändere Werte in der Datenbank
			try{
				// set the PDO error mode to exception
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE ort SET aktivitaeten='$aktivitaeten' WHERE id='$id'";
				$dbh->exec($sql);
				//display success message
				echo "<font color='green'>Data added successfully.";
				echo "<br/><a href='admin.php'>View Result</a>";
			}
			catch(PDOException $e)
			{
				echo $sql_pic . "<br>" . $e->getMessage();
			}
		}
	}
	?>

</body>
</html>