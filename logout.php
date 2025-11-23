<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Delete the saved login cookie (student_login)
if (isset($_COOKIE['student_login'])) {
  setcookie('student_login', '', time() - 3600, "/"); // Expire cookie
}

// Redirect to login page
header("Location: index.php");
exit;
?>
