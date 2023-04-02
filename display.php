<?php
session_start();
require 'config.php';

if (isset($_SESSION['login_user'])) {
	// Retrieving values in order to display them
	$user_id = $_SESSION['login_user'];
	$sql2 = "SELECT first_name, last_name , email FROM users WHERE id = $user_id";
	$result2 = mysqli_query($conn, $sql2);
	$row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
	$fname = $row['first_name'];
	$lname = $row['last_name'];
	$mail = $row['email'];
} else {
	// Redirecting to Login Form
	header("location: login-form.php");
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Display</title>
</head>

<body>
	<h2>Welcome,
		<?php echo $fname; ?>
		<?php echo $lname; ?>!
	</h2>
	<p> First Name :
		<?php echo $fname; ?>
	</p>
	<p> Last Name :
		<?php echo $lname; ?>
	</p>
	<p> Email :
		<?php echo $mail; ?>
	</p>
	<a href="logout.php">Logout</a>
</body>

</html>