<?php
include('includes/header.php');
require('includes/db.php');
?>

<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
  $countquery = 'SELECT COUNT(title) AS val FROM albums INNER JOIN albumimages ON albums.id = albumimages.id AND albums.id = :ID';
  $countres = $dbh->prepare($countquery);
  $countres->execute(['ID' => $_GET['id']]);
  $res = $countres->fetch();
  $res = $res['val'];

  $albumname = 'SELECT title, albumdate FROM albums WHERE albums.id = :ID';
  $getname = $dbh->prepare($albumname);
  $getname->execute(['ID' => $_GET['id']]);
  $nameResult = $getname->fetch();

  $blogquery = 'SELECT title, albumdate, url FROM albums INNER JOIN albumimages ON albums.id = albumimages.id AND albums.id = :ID';
  $stmt = $dbh->prepare($blogquery);
  $istrue = $stmt->execute(['ID' => $_GET['id']]);
  if($res > 0){
      ?>
      <div class="section album album-single">
        <h4><?php echo $nameResult['title']; ?></h4>
        <p><?php echo $nameResult['albumdate']; ?></p>
        <?php
        echo "<ul class='row'>";

        while($row = $stmt->fetch()){
          ?>
          <li>
            <a href="<?php echo $row['url']; ?>" data-toggle="lightbox" data-gallery="example-gallery">
              <img class="img-responsive" src="<?php echo $row['url']; ?>" />
            </a>
          </li>
          <?php
        }

        echo "</ul>";
        ?>
      </div>
      <?php
  }
  else echo "<h1>Content not found</h1>";
}
else{
  ?>
  <div class="row">
    <?php
    $blogquery = 'SELECT albums.id, title, albumdate, photo FROM albums';
    $stmt = $dbh->query($blogquery);
      while($row = $stmt->fetch()){
        ?>
        <div class="section album album-single col-lg-3 col-md-3 col-sm-6 col-xs-12 content">
          <a href="<?php echo 'albums.php?id='.$row['id']; ?>#albums">
          <h4><?php echo $row['title']; ?></h4>
          <p><?php echo $row['albumdate'] ?></p>
          <img class="img-responsive" src="<?php echo $row['photo']; ?>" />
          </a>
        </div>
        <?php
      }
      ?>
  </div>
  <?php
}
?>

<?php
include('includes/footer.php');
?>
