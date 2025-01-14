<?php
// Database connection
$servername = "localhost";
$username = "root";  // Adjust this if necessary
$password = "";      // Adjust this if necessary
$dbname = "shop_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data (assuming the form has 'username' and 'password' fields)
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Validate that both fields are provided
    if (!empty($user) && !empty($pass)) {
        // Hash the password for security before storing it in the database
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert the data into the users table
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind the parameters (s = string for both username and password)
        $stmt->bind_param("ss", $user, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful! Redirecting to login page...";

            // Redirect to login.php after 2 seconds
            echo '<script type="text/javascript">
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 2000);
                  </script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Both username and password are required.";
    }
}

// Close the database connection
$conn->close();
?>
