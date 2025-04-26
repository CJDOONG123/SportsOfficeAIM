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
        $_SESSION['login_error'] = "Email and password are required.";
        header("Location: ../view/loginView.php");
        exit;
    }

    $stmt = $conn->prepare("CALL find_user_by_email(?)");
    if (!$stmt) {
        $_SESSION['login_error'] = "An error occurred while processing your request.";
        header("Location: ../view/loginView.php");
        exit;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true); // Prevent session fixation

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../view/adminView.php");
        } else {
            header("Location: ../view/userView.php");
        }
        exit;
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: ../view/loginView.php");
        exit;
    }
}

$conn->close();
?>
