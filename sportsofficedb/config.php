<?php
$servername = "localhost";
$username = "root"; // default for XAMPP/WAMP
$password = "";     // default is empty for local dev

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$dbname = "SportOfficeDB";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create users table with additional fields
$table = "users";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table '$table' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// Sample user data
$studentId = "2023-00001";
$fullName = "Juan Dela Cruz";
$address = "Davao City";
$sampleEmail = "admin@usep.edu.ph";
$samplePassword = "admin123"; // In real apps, hash this
$hashedPassword = password_hash($samplePassword, PASSWORD_DEFAULT);

// Check if sample user exists
$check = $conn->query("SELECT * FROM $table WHERE email = '$sampleEmail'");
if ($check->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO $table (student_id, full_name, address, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $studentId, $fullName, $address, $sampleEmail, $hashedPassword);
    $stmt->execute();
    echo "Sample user created: $sampleEmail / $samplePassword<br>";
    $stmt->close();
} else {
    echo "Sample user already exists.<br>";
}

$conn->close();
?>
