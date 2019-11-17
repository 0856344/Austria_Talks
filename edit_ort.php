
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
  include_once("database.php"); 
  // lese Ort aus der Datenkbank aus
  $sth = $dbh->prepare('SELECT * from ort where id = ?');
  $sth->execute(array($_POST['id']));
  $ort = $sth->fetch();
  $ort_id = $ort['id'];?>
  <?php include('header.php'); ?>

  <!-- zeige Eingabefelder für die Ort Informationen an und fülle sie mit aktuellen Werten-->
  <div class="col-xs-1" align="center">
    <table class="table table-striped" style="border-radius: 5px; width: 50%; margin: 0px auto; float: none;">
      <th> <?php echo $_POST['name'] ?> </th>
      <tr>
        <td>Name</td>
        <form action="edit_name_ort.php" method="post" name="form1">
          <td><input type="text" name="name" value="<?php echo $ort['name']; ?>"></td>
          <td><input type="submit" name="Submit" value="ändern"></td>
          <td><input type="hidden" name="id" value=<?php echo $_POST['id'] ?>></td>
        </form> 
      </tr>
      <tr>
        <td>Seehöhe</td>
        <form action="edit_seehoehe.php" method="post" name="form1">
          <td><input type="number" name="seehoehe" min="1" max="10000"  value="<?php echo $ort['seehoehe']; ?>"></td>
          <td><input type="submit" name="Submit" value="ändern"></td>
          <td><input type="hidden" name="id" value=<?php echo $_POST['id'] ?>></td>
        </form> 
      </tr>
      <tr>
        <td>Einwohner</td>
        <form action="edit_einwohner.php" method="post" name="form1">
          <td><input type="number" name="einwohner" min="1" max="10000"  value="<?php echo $ort['einwohner']; ?>"></td>
          <td><input type="submit" name="Submit" value="ändern"></td>
          <td><input type="hidden" name="id" value=<?php echo $_POST['id'] ?>></td>
        </form> 
      </tr>
      <tr>
        <td>Aktivitäten</td>
        <form action="edit_aktivitaeten.php" method="post" name="form1">
          <td> <textarea id="text" name="aktivitaeten" cols="100" rows="16" ><?php echo $ort['aktivitaeten']; ?> </textarea> </td>  
          <td><input type="submit" name="Submit" value="ändern"></td>
          <td><input type="hidden" name="id" value=<?php echo $_POST['id'] ?>></td>
        </form> 
      </tr>
      <tr>
        <td>Bild</td>
        <form name="frmImage" enctype="multipart/form-data" action="add_pic_ort.php" method="post" class="frmImageUpload">

         <td> <input name="userImage" type="file" class="inputFile" /></td>
         <td> <input type="submit" value="Bild hinzufügen" class="btnSubmit" /></td>
         <td><input type="hidden" name="id" value=<?php echo $_POST['id'] ?>></td>

       </tr>


     </form> 
   </td>
 </tr>

</table>
</form>
</div>
</div>

</body>
</html>