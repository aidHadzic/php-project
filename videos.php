<?php
include('includes/header.php');
require('includes/db.php');
?>

<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
  $countquery = 'SELECT COUNT(title) AS val FROM videos WHERE id = :ID';
  $countres = $dbh->prepare($countquery);
  $countres->execute(['ID' => $_GET['id']]);
  $res = $countres->fetch();
  $res = $res['val'];

  $videoquery = 'SELECT title, content, url FROM videos WHERE id = :ID';
  $stmt = $dbh->prepare($videoquery);
  $istrue = $stmt->execute(['ID' => $_GET['id']]);
  if($res > 0){
      ?>
      <div class="section album">
        <?php
        while($row = $stmt->fetch()){
          ?>
          <h3><?php echo $row['title']; ?></h3>
          <a href="<?php echo $row['url']; ?>" data-lity><h4>Watch video</h4></a><br />
          <p class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
            <?php echo $row['content']; ?>
          </p>
          <?php
        }
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
    $blogquery = 'SELECT id, title, content, url FROM videos';
    $stmt = $dbh->query($blogquery);
      while($row = $stmt->fetch()){
        ?>
        <div class="section album col-lg-3 col-md-3 col-sm-6 col-xs-12 content">
          <a href="<?php echo 'videos.php?id='.$row['id']; ?>#videos">
          <h4><?php echo $row['title']; ?></h4>
          <p>
            <?php echo $row['content']; ?>
          </p>
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
