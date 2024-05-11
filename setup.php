<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'];
    $dbname = $_POST['dbname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL
            )";
        $pdo->exec($sql);
        $configData = "<?php
\$host = '$host';
\$dbname = '$dbname';
\$username = '$username';
\$password = '$password';

try {
    \$pdo = new PDO(\"mysql:host=\$host;dbname=\$dbname\", \$username, \$password);
    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException \$e) {
    header(\"Location: ../404.php\");
    exit;
}
?>";
        file_put_contents('config/db.php', $configData);
        unlink(__FILE__);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Could not connect to the database $dbname :" . $e->getMessage();
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Database</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 360px;
        }
        h1 {
            font-size: 24px;
            color: #5a5ea6;
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #6658d3;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #5848c2;
        }
    </style>
</head>
<body class="setup">
    <form method="post" action="">
        <h1>Setup Database Connection</h1>
        <label for="host">Database Host:</label>
        <input type="text" id="host" name="host" value="127.0.0.1" required>
        <label for="dbname">Database Name:</label>
        <input type="text" id="dbname" name="dbname" required>
        <label for="username">Database Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Database Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Setup">
    </form>
</body>
</html>
<?php
}
?>
