<?php
session_start();
require 'config.php';

if (isset($_POST['submit'])) {

	// Extracting Form Details
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	// Validating the Email Address
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		die("Invalid email format.");
	}

	// Password Strength Checking
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number = preg_match('@[0-9]@', $password);
	if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		die("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.");
	}

	// Checking if confirm password is same or not
	if ($password !== $confirm_password) {
		die("Passwords do not match.");
	}

	// Adding value to database
	$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";
	if (mysqli_query($conn, $sql)) {
		echo "<script>
		alert('User registerd!');
		window.location.href='index.php';
		</script>";

	} else {
		echo "<script>alert('Something went wrong!')</script>";
	}

}

// Closing the connection after form has been submitted
mysqli_close($conn);

?>


<!DOCTYPE html>
<html>

<head>
	<title>User Registration Form</title>
</head>

<body>
	<h2>User Registration Form</h2>
	<form action="" method="post">
		<label>First Name:</label>
		<input type="text" name="first_name" required><br><br>

		<label>Last Name:</label>
		<input type="text" name="last_name" required><br><br>

		<label>Email:</label>
		<input type="email" name="email" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" required><br><br>

		<label>Confirm Password:</label>
		<input type="password" name="confirm_password" required><br><br>

		<input type="submit" name="submit" value="Register">
	</form>
</body>

</html>