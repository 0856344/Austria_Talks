
<style>
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
  width: 70%;
  margin: auto;
}
</style>


<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- zeige 4 Bilder an -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" style=" width:100%; height: 500px;">
      <!-- eine Slide muss als aktiv gesetzt werden (Start) -->
      <div class="item active">
        <?php
        $sql = $dbh->prepare("select * from bild where hotel_id = :hotel_id");
        $sql->execute(array(':hotel_id' => $hotel['id']));
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        $image = '<img src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'" width=400/>';

        ?>
        <?php echo $image; ?>
      </div>

      <!-- die restlichen Slides werden hier erstellt-->
      <?php
      $sql = $dbh->prepare("select * from bild where hotel_id = :hotel_id LIMIT 30 OFFSET 1");
      $sql->execute(array(':hotel_id' => $hotel['id']));
      while($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        $image = '<img src="data:image/jpeg;base64,'.base64_encode( $result['pic'] ).'" width=400/>';
        ?>
        <div class="item">
          <?php echo $image; ?>
        </div>
        <?php
      }
      ?>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
