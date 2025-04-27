<?php
// File: /controller/resetPassword.php

session_start();
require '../database/config.php';

global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($newPassword) || empty($confirmPassword)) {
        exit('Both password fields are required.');
    }

    if ($newPassword !== $confirmPassword) {
        exit('Passwords do not match.');
    }

    if (strlen($newPassword) < 6) {
        exit('Password must be at least 6 characters.');
    }

    $email = $_SESSION['email_for_reset'] ?? null;

    if (!$email) {
        exit('Session expired. Please restart the process.');
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updated = false;

    // Try updating user
    $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $updated = true;
    }

    // Try updating admin if not found in users
    if (!$updated) {
        $stmt = $conn->prepare("UPDATE admins SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $updated = true;
        }
    }

    unset($_SESSION['email_for_reset']);

    if ($updated) {
        header('Location: ../view/loginView.php?message=Password reset successful!');
        exit();
    } else {
        exit('Failed to reset password. Please contact support.');
    }
}
?>
