<?php
define('LOGIN_COOKIE_LIFETIME', 60 * 60 * 24 * 60); // 60 days

// Auto-login using cookie (only if no session)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["student"]) && isset($_COOKIE["student_login"])) {
    $_SESSION["student"] = $_COOKIE["student_login"];
    header("Location: ../dashboard.php");
    exit;
}

// Handle login submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $data = json_decode(file_get_contents(__DIR__ . "/students.txt"), true);

    if (isset($data[$username]) && $data[$username] === $password) {
        // Valid login
        $_SESSION["student"] = $username;

        // Save cookie for 60 days
        setcookie("student_login", $username, time() + LOGIN_COOKIE_LIFETIME, "/");

        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
