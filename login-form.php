<?php
session_start();
require 'config.php';

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	// Checking Credentials
	$sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		// Redirecting to Welcome Page
		$_SESSION['login_user'] = $row['id'];
		header("location: welcome.php");
	} else {
		// Displaying Error Message
		echo "<script>alert('Invalid Email or Password.')</script>";
	}
}
?>



<!DOCTYPE html>
<html>

<head>
	<title>User Login</title>
</head>

<body>
	<h2>User Login</h2>
	<form action="" method="post">
		<label>Email:</label>
		<input type="email" name="email" required><br><br>
		<label>Password:</label>
		<input type="password" name="password" required><br><br>
		<input type="submit" value="Login" name="submit">
	</form>
</body>

</html>