<?php
// File: /controller/emailOTP.php

session_start();
require '../database/config.php'; // Your DB connection

global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'send_otp') {
        $email = $_POST['email'];

        // Check if email exists in users or admins
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? UNION SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email_for_reset'] = $email;

            // Send OTP Email
            $subject = "Your OTP Code";
            $message = "Your OTP code for password reset is: $otp";
            $headers = "From: noreply@yourdomain.com\r\n";

            if (mail($email, $subject, $message, $headers)) {
                echo json_encode(['status' => 'success', 'showOtp' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP email.']);
            }

        } else {
            echo json_encode(['status' => 'error', 'message' => 'Email not found']);
        }
    }

    if ($_POST['action'] === 'verify_otp') {
        $otp = $_POST['otp'];

        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $otp) {
            unset($_SESSION['otp']);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid OTP']);
        }
    }
}
?>

<script>
    // JavaScript to handle showing OTP field
    const sendOtpBtn = document.getElementById('send-otp-btn');
    sendOtpBtn.addEventListener('click', function () {
        const email = document.getElementById('email').value;

        fetch('../controller/emailOTP.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=send_otp&email=' + encodeURIComponent(email)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.showOtp) {
                    document.querySelector('.otpverify').style.display = 'flex';
                    alert('OTP sent successfully!');
                } else {
                    alert(data.message);
                }
            });
    });
</script>
