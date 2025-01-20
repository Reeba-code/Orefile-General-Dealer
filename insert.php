<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "shop_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (!empty($user) && !empty($pass)) {
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $user, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful! Redirecting to login page...";

            echo '<script type="text/javascript">
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 2000);
            </script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Both username and password are required.";
    }
}

$conn->close();

