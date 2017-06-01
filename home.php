<html>
<head></head>
<body>

<?php
include('includes/header.php');
require('includes/db.php');
?>

<section id="blogSection" class="separated">
  <div class="row title">
    <h4>Latest posts</h4>
  </div>
  <div class="row">
    <?php
    $blogquery = 'SELECT * FROM blog LIMIT 4';
    $stmt = $dbh->query($blogquery);
    while ($row = $stmt->fetch())
      {
        ?>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 section content">
            <img class="img-responsive" src="<?php echo $row['photo']; ?>"/>
            <h4><?php echo $row['title']; ?></h4>
            <p><?php echo $row['summary']; ?></p>
            <a href="<?php echo 'blog.php?id='.$row['id']; ?>#blog">Read more...</a>
          </div>
        <?

      }
    ?>
  </div>
</section>

<section id="albumSection" class="separated">
  <div class="row title">
    <h4>Latest albums</h4>
  </div>
  <div class="row">
    <?php
    $blogquery = 'SELECT albums.id, title, albumdate, photo FROM albums LIMIT 4';
    $stmt = $dbh->query($blogquery);
      while($row = $stmt->fetch()){
        ?>
        <div class="section col-lg-3 col-md-3 col-sm-6 col-xs-12 content">
          <a class="mainImg" href="<?php echo 'albums.php?id='.$row['id']; ?>#albums">
          <h4><?php echo $row['title']; ?></h4>
          <p><?php echo $row['albumdate'] ?></p>
          <img class="img-responsive" src="<?php echo $row['photo']; ?>" />
          </a>
        </div>
        <?php
      }
      ?>
  </div>
</section>

<section id="videosSection" class="separated">
  <div class="row title">
    <h4>Latest videos</h4>
  </div>
  <div class="row">
    <?php
    $blogquery = 'SELECT id, title, content, url FROM videos LIMIT 4';
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
</section>

<?php
include('includes/footer.php');
?>
</body>
</html>