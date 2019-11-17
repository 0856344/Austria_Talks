
<!DOCTYPE html>
<html>
<head>
  <title>Administrator</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link href="includes/style.css" type="text/css" rel="stylesheet">
  <script src="includes/script.js" type="text/javascript"></script>
</head>

<body>
  <?php
//including the database connection file
  include_once("database.php");?>

  <?php
  // füge Header ein
   include('header.php'); ?>

  <div class="col-xs-1" align="center">
  <!-- Eingabefelder für die Erzeugung eines neuen Ortes -->
   <form action="create_ort_db.php" method="post" name="form1">

    <table class="table table-striped" style="border-radius: 5px; width: 50%; margin: 0px auto; float: none;">
      <tr>
        <td>Ortname</td>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <td>Seehöhe</td>
        <td><input type="number" name="seehoehe" min="1" max="10000"></td>
      </tr>
      <tr>
        <td>Einwohner</td>
        <td><input type="number" name="einwohner" min="1" max="10000"></td>
      </tr>
      <tr>
        <td>Aktivitäten</td>
        <td> <textarea id="text" name="aktivitaeten" cols="100" rows="16"></textarea> </td>  
      </tr>

    </td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" name="Submit" value="hinzufügen"></td>
  </tr>
</table>
</form>
</div>


</body>
</html>