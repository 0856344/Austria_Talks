<html>
<head>
	<title>Add Pic</title>
</head>

<body>
	<?php
	include_once("database.php");
	$hotel_id = $_POST['id'];
	if(count($_FILES) > 0) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
			$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
			try{
				//aktiviere Error Reporting
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// füge Bild in Datenbank ein
				$sql_pic = "INSERT INTO bild(id,pic,hotel_id) VALUES 
				(NULL,'{$imgData}', '$hotel_id')";
				$dbh->exec($sql_pic);
			//display success message
				echo "<font color='green'>Data added successfully.";
				echo "<br/><a href='index.php'>View Result</a>";
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}?>

</body>
</html>
