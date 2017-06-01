<?php
include 'includes/header.php';
require 'includes/db.php';

function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function required($string) {
	return strlen($string)>3;
}
?>

<form action = "guestbook.php" method = "POST">
	Nickname:<input type = "text" name = "nickname" id = "nickname"/>
	Email:<input type = "text" name = "email_address" id = "email_address"/>
	Web Site:<input type = "text" name = "web_site" id = "web_site"/>
	Message:<input type = "text" name = "message" id = "message"/>
	<input type = "submit" value = "Submit" name = "submit" id = "submit"/>
</form>
<table>
	<tr>
		<th>NICKNAME</th>
		<th>DATE/TIME</th>
		<th>MESSAGE</th>
	<tr>
	<?php
		$display_messages_query = 'SELECT * FROM messages where approved=1';
		$stmt_messages = $dbh->query($display_messages_query);
		while($row = $stmt_messages->fetch()){
    ?>
    <tr>
		<td><?php echo $row['nickname']; ?></td>
		<td><?php echo $row['datum']; ?></td>
		<td><?php echo $row['message']; ?></td>
	</tr>
    <?php
    }
	?>
</table>

<?php
	if (isset($_POST['submit'])) {
		
		$nickname = escape($_POST['nickname']);
		$email_address = escape($_POST['email_address']);
		$web_site = escape($_POST['web_site']);
		$message = escape($_POST['message']);
		
		if (required($nickname) && required($email_address) && required($web_site) && required($message)) {
			$guestbook_query = "insert into messages (nickname,email_address,web_site,message,approved,datum) VALUES (?,?,?,?,?,?)";
			$stmt = $dbh->prepare($guestbook_query);
			$approved = '0';
			$date = date('Y-m-d H:i:s');

			if ($stmt->execute(array($nickname,$email_address,$web_site,$message,$approved,$date))){}
			else {
				echo "\nPDO::errorInfo():\n";
				print_r($dbh->errorInfo());
			}
		}
		else {
			echo '<script type = "text/javascript">alert("All fields are required and should have more than 3 characters")</script>';
		}
	}
	
?>

<?php
include 'includes/footer.php';
?>

