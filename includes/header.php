<!DOCTYPE html>
<html>
<head>
  <title>Project</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/style.css" />
  <link rel="stylesheet" href="assets/lity/dist/lity.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
  <script src="assets/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/lity/dist/lity.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
        <li><a href="guestbook.php">Guestbook</a></li>
        <li><a href="albums.php#albums">Albums</a></li>
        <li><a href="videos.php#videos">Videos</a></li>
        <li><a href="blog.php#blog">Blog</a></li>
		<?php 
			session_start();
			if(isset($_SESSION['user'])) {
				echo '<li><a href="logout.php">Logout</a></li>';
			}
			else if (isset($_SESSION['admin'])) {
				echo '<li><a href="admin.php">Admin Page</a></li>';
				echo '<li><a href="logout.php">Logout</a></li>';
			}
			else {
				echo '<li><a href="login.php">Login</a></li>';
			}
		?>
      </ul>
    </div>
  </nav>
  <main>
    <div class="container">
	<?php error_reporting(0); ?>