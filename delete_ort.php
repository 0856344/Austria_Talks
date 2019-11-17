<html>
<head>
	<title>Add Data</title>
</head>

<body>
	<?php
	//including the database connection file
	include_once("database.php");
	//lese Ort ID
	$id = $_POST['id'];
	
	//lösche Ort, falls Ort ID gesetzt ist
	if(isset($_POST['Submit'])) { 
		$id = $_POST['id'];
		$sql = "DELETE FROM ort WHERE id='$id'";
		$dbh->exec($sql);
		echo "<font color='green'>Data deleted successfully.";
		echo "<br/><a href='admin.php'>View Result</a>";
		
	}
	?>
</body>
</html>
