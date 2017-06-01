<?php

session_start();
if(!isset($_SESSION['admin'])){
	echo'PAGE RESTRICTED FOR REGULAR USER';
	echo "<script>setTimeout(\"location.href = '../blog.php';\",3000);</script>";
}
else {
	require 'includes/db.php';
	$id = $_GET['id'];
	$sql = "delete from messages WHERE id=:ID";
	$query = $dbh->prepare($sql);
	$query->execute(['ID'=>$id]);
	header('Location: admin.php');
}