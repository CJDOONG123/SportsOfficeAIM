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

    // Call stored procedure
    $stmt = $conn->prepare("CALL LoginUser(?, ?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (isset($user['role'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../../admin/PHP/admin.php");
        } else {
            header("Location: ../../user/PHP/user.php");
        }
        exit;
    } else {
        echo $user['message'];
    }

    $stmt->close();
}

$conn->close();
?>
