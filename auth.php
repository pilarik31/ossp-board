<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST['loginForm'];
    $pass = $form['password'];

    if (password_verify($pass, password_hash('admin', PASSWORD_DEFAULT))) {
        $_SESSION['admin'] = true;
        header('Location: /kiosk/admin.php');
        exit();
    } else {
        header('Location: /kiosk/login.php?error=1');
        exit();
    }
} else {
    header('Location: /kiosk/login.php');
    exit();
}
