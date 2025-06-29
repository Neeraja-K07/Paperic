<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// JavaScript code to display an alert and redirect
echo '<script>alert("You have been logged out."); window.location.href = "loginsignup.php";</script>';
?>
