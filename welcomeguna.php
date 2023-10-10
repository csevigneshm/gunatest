<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION["email"]; ?></h1>
    <p>This is the welcome page.</p>
    <a href="gunalogout.php">Logout</a>
</body>
</html>
