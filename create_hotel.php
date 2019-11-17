
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
  // Turn off all error reporting (Damit keine Warnungen angezeigt werden)
  error_reporting(0);
  ?>
   <!--binde Datenbank ein-->
  <?php include_once("database.php"); ?>

  <!--füge Header ein-->
  <?php include('header.php'); ?>
  <div class="col-xs-1" align="center">

  <!--zeige Formular für die Erzeugung eines neuen Hotels an-->
   <form action="create_hotel_db.php" method="post" name="form1">
    <table class="table table-striped" style="border-radius: 5px; width: 50%; margin: 0px auto; float: none;"> 
      <tr>
        <td>Hotelname</td>
        <td><input type="text" name="name" size="50px"></td>
      </tr>
      <tr>
        <td>Beschreibung</td>
        <td> <textarea id="text" name="description" cols="100" rows="16"></textarea> </td>  
      </tr>
      <tr>
        <td>Email</td>
        <td><input type="text" name="email" size="50px"></td>
      </tr>
      <tr>
        <td>Telefon</td>
        <td><input type="text" name="telefon" size="50px"></td>
      </tr>
      <tr>
        <td>Adresse</td>
        <td><input type="text" name="adresse" size="50px"></td>
      </tr>
      <tr>
        <td>Anfahrtsbeschreibung</td>
        <td> <textarea id="text" name="anfahrt" cols="100" rows="8"></textarea> </td> 
      </tr>
      <tr>
        <td>Kategorie</td>
        <td><input type="number" name="kategorie" min="1" max="5"></td>
      </tr>
      <tr>
        <td>Bewertung</td>
        <td><input type="number" name="bewertung" step="0.01" min="1" max="5"></td>
      </tr>

      <tr><th>Ausstattung</th></tr>
      <tr><td><input type="checkbox" name="wlan" value="wlan">WLan</td></tr>
      <tr><td><input type="checkbox" name="sauna" value="sauna">Sauna</td></tr>
      <tr><td><input type="checkbox" name="whirlpool" value="whirlpool">Whirlpool</td></tr>
      

      
      <tr>
        <td>Ort</td>
        <td>
          <select id=ort; name="ort" > 
            <?php 
            $sql = "SELECT id,name FROM ort ORDER BY name"; 
                  // für jeden Eintrag in Orte eine Auswahlmöglichkeit erstellen                 
            foreach ($dbh->query($sql) as $ort) {
              echo '<option value="'.$ort['id'].'"'.($_POST['name'] == $ort['id'] ? " selected": "").'>'.$ort['name'].'</option>'; 
            } 
            ?> 
          </select> 
        </tr>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="Submit" value="hinzufügen"></td>
    </tr>
  </table>
</form>



</body>
</html>