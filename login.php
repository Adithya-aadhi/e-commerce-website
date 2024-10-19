<?php
session_start();

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'ecom_user_db';


$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM userid WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: index.html');
        exit();
    } else {
        header('Location: login.html?error=invalid');
        exit();
    }

    $stmt->close();
} else {
    header('Location: login.html?error=missing');
}

$conn->close();
?>
