
<?php
require_once('database.php');
?>

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
<!--füge Header ein-->
 <?php include('header.php'); ?>

 <div class="container" >
  <div class="row">
    <div class="col-md-6">
      <table class="table table-striped">
       <?php
       // erstelle eine Liste mit den Hotels zum editieren & löschen
       foreach ($dbh->query('SELECT * from hotel') as $hotel) {
        ?>
        <tr>
          <!--name-->
          <td> <?php echo $hotel['id']; ?></td>
          <!--edit-->
          <td>  
            <form action="edit.php" method="post">
              <td><input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['id']) ?>"></td>
              <td> <input type="submit" name="Submit" value="bearbeiten"> </td>
            </form>
          </td>
          <!--delete-->
          <td>  
           <form action="delete.php" method="post">
             <td><input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['id']) ?>"></td>
             <td><input type="submit" name="Submit" value="löschen"></td>
           </form>
         </td>

       </tr>


       <?php
     }
     ?>

   </table>
 </div>


 <div class=" col-md-6">
   <table class="table table-striped">
     <?php
     // erstelle eine Liste der Orte zum editieren & löschen
     foreach ($dbh->query('SELECT * from ort') as $ort) {
      ?>
      <tr>
        <!--name-->
        <td> <?php echo $ort['name']; ?></td>

        <!--edit-->
        <td>  
          <form action="edit_ort.php" method="post">
            <td><input type="hidden" name="id" value=<?php echo $ort['id'] ?>></td>
            <?php $name =  $ort['name'] ?>
            <td><input type="hidden" name="name" value="<?php echo htmlspecialchars($ort['name']); ?>"</td>
            <td> <input type="submit" name="Submit" value="bearbeiten"></td>
          </form>
        </td>

        <!--delete-->
        <td>  
          <form action="delete_ort.php" method="post">
            <td><input type="hidden" name="id" value="<?php echo htmlspecialchars($ort['id']) ?>"></td>
            <td> <input type="submit" name="Submit" value="löschen"></td>
          </form>
        </td>
      </tr>

      <?php
    }
    ?>
  </table>
</div>
</div>
<div class="row">
  <div class=" col-md-6">
    <!--neues Hotel hinzufügen-->
   <form  action="create_hotel.php"><input  type="submit" value="neues Hotel" /></form>
 </div>
 <div class=" col-md-6">
   <!--neuen Ort hinzufügen-->
   <form  action="create_ort.php"><input  type="submit" value="neuer Ort" /></form>
 </div>
 
</div>


</body>
</html>