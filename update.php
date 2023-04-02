<?php
session_start();
require 'config.php';

if (isset($_SESSION['login_user'])) {

	$user_id = $_SESSION['login_user'];

	// To get the current user data from the MySQL database
	$sql = "SELECT * FROM users WHERE id = $user_id";
	$result = mysqli_query($conn, $sql);

	$user_data = mysqli_fetch_assoc($result);

	// To check if the user data exists
	if (!$user_data) {
		die("User not found.");
	}

	if (isset($_POST['update'])) {
		// To get the values submitted from the form
		$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

		// To check if the passwords match
		if ($password !== $confirm_password) {
			die("Passwords do not match.");
		}

		// Update the user data in the MySQL database
		$sql2 = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', password = '$password' WHERE id = $user_id";
		if (mysqli_query($conn, $sql2)) {
			echo "<script>
		alert('User updated!');
		window.location.href='welcome.php';
		</script>";
		} else {
			echo "<script>alert('Something went wrong!')</script>";
		}
	}


	if (isset($_POST['cancel'])) {
		// Redirect to welcome page
		header("Location: welcome.php");
	}
}

// Close the MySQL database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
	<title>User Information updation Form</title>
</head>

<body>
	<h2>User Info Update</h2>
	<form method="POST" action="">
		<label>First Name:</label>
		<input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>" required><br><br>

		<label>Last Name:</label>
		<input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" value="<?php echo $user_data['password']; ?>" required><br><br>

		<label>Confirm Password:</label>
		<input type="password" name="confirm_password" value="<?php echo $user_data['password']; ?>" required><br><br>

		<input type="submit" name="update" value="Update">
		<input type="submit" name="cancel" value="Cancel">
	</form>
</body>

</html>