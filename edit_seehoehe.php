<html>
<head>
	<title>Add Data</title>
</head>

<body>

	<?php
	include_once("database.php");
	if(isset($_POST['Submit'])) {    
		$seehoehe = $_POST['seehoehe'];
		$id = $_POST['id'];

		if(empty($seehoehe)) {
			echo "<font color='red'>description11 field is empty.</font><br/>";
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		}
		else { 
			// if all the fields are filled (not empty)             
			// ändere Werte in der Datenbank
			try{
				// set the PDO error mode to exception
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE ort SET seehoehe='$seehoehe' WHERE id='$id'";
				// use exec() because no results are returned
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