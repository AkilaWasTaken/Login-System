<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include_once('../includes/assets.inc.php'); ?>
</head>
<body data-theme="light">
    <?php include_once('../includes/nav.inc.php');?>
    <div class="dashboard">
        <div class="welcome">Welcome to Your Dashboard!</div>
        <div class="navigation">
            <a href="profile.php">Profile</a>
            <a href="settings.php">Settings</a>
            <a href="../handlers/process_logout.php">Logout</a>
        </div>
    </div>
<?php include_once('../includes/footer.inc.php');?>
</body>
</html>
