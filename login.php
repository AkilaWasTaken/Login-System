<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<?php include_once('includes/assets.inc.php'); ?>
</head>
<body data-theme="light">
    <div class="dark-mode-toggle" onclick="toggleDarkMode()"></div>
    <form action="./handlers/process_login.php" method="post">
        <h2>Login</h2>
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <?php 
        if (isset($_SESSION['error'])): ?>
            <div style="color: red; margin-bottom: 10px;"><?= htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <input type="submit" value="Login" class="submit-btn">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
    <script src="script.js"></script>
</body>
</html>
