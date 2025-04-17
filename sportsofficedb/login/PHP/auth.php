<?php
// auth.php

session_start();

// DB connection
$host = 'localhost';
$db = 'usep_sports';
$user = 'root';
$pass = ''; // Change this for production

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        die('Email and password are required.');
    }

    // Prepare statement
    $stmt = $conn->prepare("SELECT id, email, password, fullname FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header('Location: dashboard.php');
            exit;
        } else {
            echo 'Invalid credentials.';
        }
    } else {
        echo 'Invalid credentials.';
    }

    $stmt->close();
}

$conn->close();

