<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dbname = "SportOfficeDB";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($dbname);

// Create students table
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

$adminCheck = $conn->query("SELECT COUNT(*) AS total_admins FROM admins");
$adminCount = $adminCheck ? $adminCheck->fetch_assoc()['total_admins'] : 0;

if ($adminCount < 2) {
    $fullName = "Gian Glen Vincent Garcia";
    $address = "Tagum City";
    $sampleEmail = "admin@usep.edu.ph";
    $samplePassword = "admin123";
    $hashedPassword = password_hash($samplePassword, PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM admins WHERE email = '$sampleEmail'");
    if ($check && $check->num_rows == 0) {
        $status = "alumni";
        $stmt = $conn->prepare("INSERT INTO admins (full_name, address, email, password, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullName, $address, $sampleEmail, $hashedPassword, $status);
        $stmt->execute();
        echo "Admin user created: $sampleEmail / $samplePassword<br>";
        $stmt->close();
    } else {
        echo "Admin user already exists.<br>";
    }
} else {
    echo "Admin limit reached. No more admins can be added.<br>";
}

$result = $conn->query("SELECT COUNT(*) AS total FROM users");
if ($result) {
    $row = $result->fetch_assoc();
    echo "Total number of students: " . $row['total'] . "<br>";
} else {
    echo "Error counting students: " . $conn->error;
}

$conn->close();
?>