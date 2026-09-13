<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statements to prevent SQL injection.
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
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
