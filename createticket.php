<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $subject = $_POST["subject"];
    
    $user_id = $_SESSION['user_id']; 
    $status = "New";
    $creation_date = date("Y-m-d H:i:s");

    
    $insert_query = "INSERT INTO tickets (title, subject, user_id, status, creation_date) VALUES ('$title', '$subject', '$user_id', '$status', '$creation_date')";

   
    if (mysqli_query($conn, $insert_query)) {
      
        header("Location: view_my_tickets.php");
        exit();
    } else {
       
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Ticket</title>
</head>
<body>
    <h1>Create Ticket</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Form fields to collect ticket information -->
        <p><input type="submit" value="Submit"></p>
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>