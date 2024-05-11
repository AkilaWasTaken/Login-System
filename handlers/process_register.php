<?php
session_start();
require '../config/db.php';

function redirectWithError($url, $error) {
    $_SESSION['error'] = $error;
    header("Location: $url");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        redirectWithError("../register.php", "Passwords do not match!");
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        redirectWithError("../register.php", "Username already taken!");
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $hash])) {
        $_SESSION['success'] = 'Registration successful! You may now log in.';
        header("Location: ../login.php");
        exit;
    } else {
        redirectWithError("../register.php", "Registration failed!");
    }
}
?>
