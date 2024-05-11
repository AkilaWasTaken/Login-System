<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
	<?php include_once('includes/assets.inc.php'); ?>
</head>
<body data-theme="light">
    <div class="dark-mode-toggle" onclick="toggleDarkMode()"></div>
    <form action="./handlers/process_register.php" method="post">
        <h2>Register</h2>
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <?php
        session_start();
        if (isset($_SESSION['error'])): ?>
            <div style="color: red; margin-bottom: 10px;"><?= htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <input type="submit" value="Register" class="submit-btn">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
    <script src="script.js"></script>
</body>
</html>
