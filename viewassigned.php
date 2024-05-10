<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>View Assigned Tickets</title>
</head>
<body>
    <h1>View Assigned Tickets</h1>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>