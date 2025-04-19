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
    student_id VARCHAR(50),
    full_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') NOT NULL DEFAULT 'student',
    UNIQUE(student_id)
)";

// Check how many admin users exist
$adminCheck = $conn->query("SELECT COUNT(*) AS total_admins FROM $table WHERE role = 'admin'");
$adminCount = $adminCheck->fetch_assoc()['total_admins'];

if ($adminCount < 2) {
    $fullName = "Gian Glen Vincent Garcia";
    $address = "Tagum City";
    $sampleEmail = "admin@usep.edu.ph";
    $samplePassword = "admin123";
    $hashedPassword = password_hash($samplePassword, PASSWORD_DEFAULT);
    $role = "admin";

    // Check if this specific admin email exists
    $check = $conn->query("SELECT * FROM $table WHERE email = '$sampleEmail'");
    if ($check->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO $table (student_id, full_name, address, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $nullStudentId = null;
        $stmt->bind_param("ssssss", $nullStudentId, $fullName, $address, $sampleEmail, $hashedPassword, $role);
        $stmt->execute();
        echo "Admin user created: $sampleEmail / $samplePassword<br>";
        $stmt->close();
    } else {
        echo "Admin user already exists.<br>";
    }
} else {
    echo "Admin limit reached. No more admins can be added.<br>";
}


// Count total number of students
$result = $conn->query("SELECT COUNT(*) AS total FROM $table");
if ($result) {
    $row = $result->fetch_assoc();
    echo "Total number of students: " . $row['total'] . "<br>";
} else {
    echo "Error counting students: " . $conn->error;
}


$conn->close();
?>
