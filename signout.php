<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: loginsignup.php");
exit(); // Make sure to exit after redirection
?>
