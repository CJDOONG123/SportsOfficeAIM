<?php
// editUsers.php

// Include your database connection
global $conn;
require_once '../database/config.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input values
    $student_id = trim($_POST['student_id']);
    $full_name = trim($_POST['full_name']);
    $address = trim($_POST['address']);
    $status = trim($_POST['status']);

    // Simple validation
    if (empty($student_id) || empty($full_name) || empty($address) || empty($status)) {
        die('Please fill out all required fields.');
    }

    try {
        // Prepare the UPDATE query
        $sql = "UPDATE users 
                SET full_name = :full_name, address = :address, status = :status 
                WHERE student_id = :student_id";

        $stmt = $conn->prepare($sql); // ✅ Prepare the statement

        // Bind parameters
        $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            header('Location: ../admin/Users.php?success=UserUpdated');
            exit();
        } else {
            echo "Failed to update user.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid Request.";
}
?>
