<html>
<head>
	<title>Add Data</title>
</head>

<body>
	<?php
//including the database connection file
	include_once("database.php");

	//lese die Felder für die Anlage eines neuen Hotels aus 
	if(isset($_POST['Submit'])) {    
		$name = $_POST['name'];
		$seehoehe = $_POST['seehoehe'];
		$einwohner = $_POST['einwohner'];
		$aktivitaeten = $_POST['aktivitaeten'];

    	// checking empty fields
		if(empty($aktivitaeten) || empty($name) || empty($seehoehe)|| empty($einwohner)) {                
			if(empty($aktivitaeten)) {
				echo "<font color='red'>Name field is empty.</font><br/>";
			}

			if(empty($name)) {
				echo "<font color='red'>description11 field is empty.</font><br/>";
			}


			if(empty($seehoehe)) {
				echo "<font color='red'>Email field is empty.</font><br/>";
			}
			if(empty($einwohner)) {
				echo "<font color='red'>ort field is empty.</font><br/>";
			}


        //link to the previous page
			echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
		} else { 
        	// if all the fields are filled (not empty)             
        	//insert data to database
			try{
				//füge Ort in Datenbank ein			
    			// set the PDO error mode to exception
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql = "INSERT INTO ort (id, name, seehoehe,einwohner,aktivitaeten) VALUES (NUll,'$name',$seehoehe,$einwohner,'$aktivitaeten')";
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
