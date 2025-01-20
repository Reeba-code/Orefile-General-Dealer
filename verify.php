<?php

include('config.php');
session_start(); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

   
    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
          
            if (password_verify($password, $user['password'])) {
           
                $_SESSION['username'] = $username; 

                
                header("Location: checkout.php");
                exit();
            } else {
               
                $error_message = "Invalid username or password.";
            }
        } else {
          
            $error_message = "Invalid username or password.";
        }

        
        $stmt->close();
    } else {
        $error_message = "Database error: " . $mysqli->error;
    }

    
    $mysqli->close();
}


if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>
