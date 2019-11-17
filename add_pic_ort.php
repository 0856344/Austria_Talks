<html>
<head>
	<title>Add Pic</title>
</head>

<body>
	<?php
	include_once("database.php");
	$id = $_POST['id'];
	if(count($_FILES) > 0) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
			$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
			//füge Bild in Datenbank ein
			$sql = "UPDATE ort SET bild='{$imgData}' WHERE id='$id'";
			$dbh->exec($sql);
			echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='admin.php'>View Result</a>";
		}
	}?>

</body>
</html>
