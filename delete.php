<?php
session_start();
require 'config.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['login_user'])) {
	header("Location: login.php");
	exit();
}

// Retrieve the user's information
$user_id = $_SESSION['login_user'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if (isset($_POST['delete'])) {
	// Delete the user's information from the database
	$query = "DELETE FROM users WHERE id='$user_id'";
	mysqli_query($conn, $query);

	// Destroy the user's session
	session_destroy();

	// Redirect the user to the homepage
	header("Location: index.php");
	exit();
}

// Check if the form has been cancelled
if (isset($_POST['cancel'])) {
	// Redirect to welcome page
	header("Location: welcome.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Delete Account</title>
</head>

<body>
	<h1>Delete Account</h1>
	<p>Are you sure you want to delete your account?</p>
	<form method="post">
		<input type="submit" name="delete" value="Delete">
		<input type="submit" name="cancel" value="Cancel">
	</form>
</body>

</html>