<?php
// To connect to the MySQL database
$host = "localhost"; // Replace with your host name
$user = "root"; // Replace with your MySQL username
$password = "password"; // Replace with your MySQL password
$db_name = "dblab8"; // Replace with your MySQL database name
$conn = mysqli_connect($host, $user, $password, $db_name);


// To check for errors
if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>