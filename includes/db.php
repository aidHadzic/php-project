<?php
try{
  $dbh = new PDO('mysql:host=localhost;dbname=laravel_app', 'root', '');
}
catch(Exception $e){
  die("database error");
}

?>
