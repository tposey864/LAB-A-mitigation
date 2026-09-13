<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// VULNERABILITY 2: Vulnerable SQL Injection (SQLi)
// User inputs ($username and $password) are concatenated directly into the command string.
// A malicious actor can use payloads like "admin' #" to bypass authentication entirely.
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result !== FALSE && $result->num_rows > 0) {
    // Successful login
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    header("Location: dashboard.php");
    exit();
} else {
    // Login failed
    echo "Login failed!";
}

$conn->close();
?>
