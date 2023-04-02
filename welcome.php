<?php
session_start();
require 'config.php';

if (isset($_SESSION['login_user'])) {
	// Retrieving user data from database
	$user_id = $_SESSION['login_user'];
	$sql = "SELECT first_name, last_name FROM users WHERE id = $user_id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$name = $row['first_name'] . ' ' . $row['last_name'];
} else {
	header("location: login-form.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Welcome</title>
</head>

<body>
	<h2>Welcome,
		<?php echo $name; ?>!
	</h2>
	<p>You have successfully logged in.</p>
	<a href="display.php">Display Profile</a><br>
	<a href="update.php">Update Profile</a><br>
	<a href="delete.php">Delete Profile</a><br>
	<a href="logout.php">Logout</a>
</body>

</html>