
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <?php
  //including the database connection file
  include_once("database.php"); 
  // lese Hotel aus der Datenbank
  $sth = $dbh->prepare('SELECT * from hotel where id = ?');
  $sth->execute(array($_POST['id']));
  $hotel = $sth->fetch();
  $hotel_id = $hotel['id'];?>

  <?php
  //zeige Header an
  include('header.php'); ?>

  <!-- zeige Eingabefelder für die Hoteldaten an und zeige die aktuellen Inhalte-->
  <div class="col-xs-1" align="center">
    <table class="table table-striped" style="border-radius: 5px; width: 50%; margin: 0px auto; float: none;">

     <th> <?php echo $_POST['id'] ?> </th>
     <tr>
      <td>Beschreibung</td>
      <form action="edit_description.php" method="post" name="form1">
        <td> <textarea id="text" name="description" value="test" cols="100" rows="16" ><?php echo $hotel['description']; ?> </textarea> </td>  
        <td><input type="submit" name="Submit" value="ändern"></td>
        <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id'] )?>"></td>
      </form> 
    </tr>
    <tr>
      <td>Email</td>
      <form action="edit_email.php" method="post" name="form1">
        <td><input type="text" name="email" size="50px" value=<?php echo $hotel['email']; ?>></td>
        <td><input type="submit" name="Submit" value="ändern"></td>
        <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
      </form> 
    </tr>

    <tr>
      <td>Telefon</td>
      <form action="edit_telefon.php" method="post" name="form1">
        <td><input type="text" name="telefon" size="50px" value=<?php echo $hotel['telefon']; ?>></td>
        <td><input type="submit" name="Submit" value="ändern"></td>
        <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
      </form> 
    </tr>

    <tr>
      <td>Adresse</td>
      <form action="edit_adresse.php" method="post" name="form1">
        <td><input type="text" name="adresse" size="50px" value=<?php echo $hotel['adresse']; ?>></td>
        <td><input type="submit" name="Submit" value="ändern"></td>
        <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
      </form> 
    </tr>

    <tr>
      <td>Anfahrtsbeschreibung</td>
      <form action="edit_anfahrt.php" method="post" name="form1">
        <td> <textarea id="text" name="anfahrt" cols="100" rows="8"><?php echo $hotel['anfahrtsbeschreibung']; ?></textarea> </td> 
        <td><input type="submit" name="Submit" value="ändern"></td>
        <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
      </form> 
    </tr>

    <tr>
      <td>Kategorie</td>
      <form action="edit_kategorie.php" method="post" name="form1">
        <td><input type="number" name="kategorie" min="1" max="5" value=<?php echo $hotel['kategorie']; ?>></td>
        <td><input type="submit" name="Submit" value="ändern"></td>
        <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
      </form> 
    </tr>

    <tr>
      <td>Bewertung</td>
      <form action="edit_bewertung.php" method="post" name="form1">
        <td><input type="number" name="bewertung" step="0.01" min="1" max="5" value=<?php echo $hotel['bewertung']; ?>>
          <td><input type="submit" name="Submit" value="ändern"></td>
          <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
        </form> 
      </tr>

      <tr>

        <form action="edit_wlan.php" method="post" name="form1">
          <td><input id="wlan" type="checkbox" name="wlan" value="wlan">WLan</td>

          <?php
          // lese die Ausstattungen des Hotels aus der Datenbank
          foreach ($dbh->query("SELECT * from ausstattung WHERE hotel_id='$hotel_id'") as $ausstattung) {?>
          <?php 
          // wenn die "wlan" Ausstattung vorhanden ist, dann setze die Checkbox auf checked
          if(strcmp($ausstattung['description'],"wlan")==0){
            ?>
            <script type="text/javascript">
              $("#wlan").prop('checked', true);
            </script>
            <?php }}?>

            <td><input type="submit" name="Submit" value="ändern"></td>
            <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
        </form> 
      </tr>

        <tr>

          <form action="edit_sauna.php" method="post" name="form1">
           <td><input id="sauna" type="checkbox" name="sauna" value="sauna">Sauna</td>

           <?php
           // lese die Ausstattungen des Hotels aus der Datenbank
           foreach ($dbh->query("SELECT * from ausstattung WHERE hotel_id='$hotel_id'") as $ausstattung) {?>
           <?php 
          // wenn die "sauna" Ausstattung vorhanden ist, dann setze die Checkbox auf checked
           if(strcmp($ausstattung['description'],"sauna")==0){
            ?>
            <script type="text/javascript">
              $("#sauna").prop('checked', true);
            </script>
            <?php }}?>


            <td><input type="submit" name="Submit" value="ändern"></td>
            <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
          </form> 
        </tr>

        <tr>

          <form action="edit_whirlpool.php" method="post" name="form1">
            <td><input id="whirlpool" type="checkbox" name="whirlpool" value="whirlpool">Whirlpool</td>

            <?php
            // lese die Ausstattungen des Hotels aus der Datenbank
            foreach ($dbh->query("SELECT * from ausstattung WHERE hotel_id='$hotel_id'") as $ausstattung) {?>
            <?php 
            // wenn die "whirlpool" Ausstattung vorhanden ist, dann setze die Checkbox auf checked
            if(strcmp($ausstattung['description'],"whirlpool")==0){
              ?>
              <script type="text/javascript">
                $("#whirlpool").prop('checked', true);
              </script>
              <?php }}?>

              <td><input type="submit" name="Submit" value="ändern"></td>
              <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
            </form> 
          </tr>
          <tr>
            <td>Bild</td>
            <!-- füge Bild hinzu -->
            <form name="frmImage" enctype="multipart/form-data" action="add_pic.php" method="post" class="frmImageUpload">
             <td> <input name="userImage" type="file" class="inputFile" /></td>
             <td> <input type="submit" value="Bild hinzufügen" class="btnSubmit" /></td>
             <td><input type="hidden" name="id" value="<?php echo htmlspecialchars($_POST['id']) ?>"></td>
           </tr>
         </form> 
       </td>
     </tr>

   </table>
 </form>
</div>

</body>
</html>