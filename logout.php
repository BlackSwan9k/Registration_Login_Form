<?php
session_start(); // To ensure that we are using the same session
session_destroy(); // To destroy the session
header("location:/index.php"); // To redirect back to index after logging out
exit();
?>