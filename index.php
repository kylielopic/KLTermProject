<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Apartment Maintenance Ticket Tracking System</title>
</head>
<body>
    <h1>Welcome to Apartment Maintenance Ticket Tracking System</h1>
    <?php if(isset($_SESSION['UserID'])): ?>
        <?php if($_SESSION['UserType'] == 'user'): ?>
            <a href="create_ticket.php">Create Ticket</a>
            <a href="view_my_tickets.php">View My Tickets</a>
        <?php elseif($_SESSION['UserType'] == 'maintenance'): ?>
            <a href="view_all_tickets.php">View All Tickets</a>
            <a href="view_assigned_tickets.php">View Assigned Tickets</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</body>
</html> 
