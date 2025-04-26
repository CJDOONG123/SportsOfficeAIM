<?php
// Simple router simulation using a GET parameter
$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        require_once '../view/loginView.php';
        break;
}


?>
