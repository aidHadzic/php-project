<!DOCTYPE html>
<head>
<title>Login form</title>
<style type="text/css">
	body{font-family:verdana; font-size:15px;}
	div#back_glob{background-color:white; border:1px solid #25b2d5; width:400px;margin:0 auto; box-shadow: 1px 0px 15px #25b2d5;}
	input{display:block; margin:10px;}
	div#back_header{background-color:#25b2d5; text-align:center; font-size:22px; font-weight:bold; color:white; padding:20px;}
	input[type=text],input[type=password]{font-size:15px; padding:10px; border-radius:3px; border:1px solid #ddd;}
	input[type=submit]{background-color:#25b2d5; padding:8px 10px 10px; border-radius:5px; border:1px solid #319db8; color:white; font-weight:bold;}	
	div#back_form{display:files;justify-content: center;}
	p{padding: 10px 0 0 10px;}
	a{text-decoration:none;}
</style>
</head>
<body>
	<div id="back_glob">
		
		<div id="back_header">
			LOGIN
		</div>
		<div id="back_form">
			<form action="" method="POST">
			<input type="text" name="username" placeholder="Username" size="41"/>
		    <input type="password" name="password" placeholder="Password" size="41"/>
			<input type="submit" value="Login" name="submit"/>
			</form>
		</div>
		<p><a href="http://localhost/resetpass.php" name="forget">Forget your password? Click here to generate new!</a></p>
	</div>
</body>
</html>


<?php

function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

if(isset($_POST['submit'])){
	$user = escape($_POST['username']);
	$pass = escape($_POST['password']);
	$messeg = "";

	if(empty($user) || empty($pass)) {
		$messeg = "Username/Password con't be empty";
	} else {
		require 'includes/db.php';
		$sql = "SELECT username,password,grupa FROM login WHERE username=:USERNAME AND password=:PASS";
		$query = $dbh->prepare($sql);
		$query->execute(['USERNAME'=>$user, 'PASS'=>$pass]);
		$row = $query->fetch();
		session_start();
		if(count($row) >= 1) {
			$group = $row['grupa'];
			if ($group == 1) {
				$_SESSION['user'] = $user;
				$_SESSION['time_start_login'] = time();
				echo '<script>alert("Welcome User!")</script>';
				header('refresh:1; url=blog.php');
			}
			else if ($group == 2) {
				$user = 'admin';
				$_SESSION['admin'] = $user;
				$_SESSION['time_start_login'] = time();
				echo '<script>alert("Welcome Admin!")</script>';
				header("refresh:1; url=admin.php");
			}
		}
		else {
			echo '<script>alert("Username or Password not correct!")</script>';
			header("refresh:1; url=login.php");
		}
	}
}

?>