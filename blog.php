<?php
include('includes/header.php');
require('includes/db.php');
?>

<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
  $blogquery = 'SELECT * FROM blog WHERE ID = :ID';
  $stmt = $dbh->prepare($blogquery);
  $stmt->execute(['ID' => $_GET['id']]);
  $row = $stmt->fetch();
  if(count($row) > 1 || $row==true){
      ?>
      <div class="section blog">
        <div class="row">
          <img class="img-responsive" src="<?php echo $row['photo']; ?>" />
        </div>
        <h3><?php echo $row['title']; ?></h3>
        <p>
          <?php echo $row['content']; ?>
        </p>
      </div>
      <?php
  }
  else echo "<h1>Content not found</h1>";
}
else{
  $blogquery = 'SELECT * FROM blog';
  $stmt = $dbh->query($blogquery);
    while($row = $stmt->fetch()){
      ?>
      <div class="section blog">
        <div class="row">
          <img class="img-responsive" src="<?php echo $row['photo']; ?>" />
        </div>
        <h3><?php echo $row['title']; ?></h3>
        <p>
          <?php echo $row['summary']; ?>
        </p>
        <a href="<?php echo 'blog.php?id='.$row['id']; ?>">Read More...</a>
      </div>
      <?php
    }
}
?>

<?php
include('includes/footer.php');
?>
