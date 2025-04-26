<?php
// File: /controller/addUsers.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SportOfficeDB";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$student_id = $_POST['student_id'];
$full_name = $_POST['full_name'];
$address = $_POST['address'];
$email = $_POST['email'];
$password = $_POST['password'];
$status = $_POST['status'];

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare the CALL to stored procedure
$stmt = $conn->prepare("CALL AddUserIfAllowed(?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $student_id, $full_name, $address, $email, $hashedPassword, $status);

// Execute
$stmt->execute();

// Get the result
$result = $stmt->get_result();
if ($result) {
    $row = $result->fetch_assoc();
    $message = $row['result'];

    // Redirect back with success or error message (optional)
    header("Location: ../view/signupView.php?message=" . urlencode($message));
    exit();
} else {
    // Error during execution
    die("Error inserting user: " . $conn->error);
}

$stmt->close();
$conn->close();
?>
