<?php
session_start();

if(isset($_SESSION['UserID'])) {
    header("Location: index.php");
    exit();
}


require_once "db_connection.php";

$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

   
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

 
    if(empty($username_err) && empty($password_err)){
      
        $sql = "SELECT UserID, Username, Password, UserType FROM Users WHERE Username = ?";

        if($stmt = $mysqli->prepare($sql)){
        
            $stmt->bind_param("s", $param_username);

      
            $param_username = $username;

          
            if($stmt->execute()){
           
                $stmt->store_result();

             
                if($stmt->num_rows == 1){
                  
                    $stmt->bind_result($UserID, $Username, $hashed_password, $UserType);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                        
                            session_start();

                            $_SESSION["UserID"] = $UserID;
                            $_SESSION["Username"] = $Username;
                            $_SESSION["UserType"] = $UserType;

                            header("location: index.php");
                        } else{
                    
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

         
            $stmt->close();
        }
    }

  
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</body>
</html>