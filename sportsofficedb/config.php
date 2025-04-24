<?php
$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$dbname = "SportOfficeDB";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) UNIQUE,
    full_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status ENUM('undergraduate', 'alumni') DEFAULT 'undergraduate'
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating users table: " . $conn->error);
}

// Create admins table
$sql = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status ENUM('undergraduate', 'alumni') DEFAULT 'undergraduate'
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating admins table: " . $conn->error);
}

// Add admin using stored procedure
$fullName = "Gian Glen Vincent Garcia";
$address = "Tagum City";
$sampleEmail = "admin@usep.edu.ph";
$samplePassword = "admin123";
$hashedPassword = password_hash($samplePassword, PASSWORD_DEFAULT);
$status = "alumni";

$stmt = $conn->prepare("CALL AddAdminIfAllowed(?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $fullName, $address, $sampleEmail, $hashedPassword, $status);
$stmt->execute();

// Fetch and display result message
$result = $stmt->get_result();
if ($result) {
    $row = $result->fetch_assoc();
    echo $row['result'] . "<br>";
}
$stmt->close();


// Count students
$result = $conn->query("CALL GetTotalStudents()");
if ($result) {
    $row = $result->fetch_assoc();
    echo "Total number of students: " . $row['total'] . "<br>";
} else {
    echo "Error counting students: " . $conn->error;
}

$conn->close();

?>
