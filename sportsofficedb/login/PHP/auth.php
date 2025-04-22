<?php
session_start();

$host = 'localhost';
$db = 'SportOfficeDB';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    // Check in admins table
    $stmt = $conn->prepare("SELECT id, email, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $adminResult = $stmt->get_result();

    if ($admin = $adminResult->fetch_assoc()) {
        if (password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['email'] = $admin['email'];
            $_SESSION['role'] = 'admin';
            header("Location: ../../admin/PHP/admin.php");
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        // Check in users table
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $userResult = $stmt->get_result();

        if ($user = $userResult->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = 'student';
                header("Location: ../../user/PHP/user.php");
                exit;
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "No user found with that email.";
        }
    }

    $stmt->close();
}

$conn->close();
?>
