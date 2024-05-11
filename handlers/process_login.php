<?php
session_start();
require '../config/db.php';

if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    header("Location: ../client/dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../client/dashboard.php"); 
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../login.php");
        exit;
    }
}
?>
