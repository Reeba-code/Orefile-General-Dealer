<?php

include('config.php');
session_start(); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

   
    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username = ?");
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
}


if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>


<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register || Orefile General Dealer</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <style>
  
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Baskerville SC', serif;
}


.top-bar {
  background-color: #003300; 
  padding: 15px 20px; 
  position: fixed; 
  top: 0;
  width: 100%; 
  z-index: 1000;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.top-bar .title-area h1 a {
  color: #fff; 
  text-decoration: none; 
  font-size: 2em; 
  font-weight: bold; 
}

.toggle-topbar.menu-icon {
  display: none; 
}

.top-bar-section ul {
  list-style: none; 
  display: flex; 
  gap: 20px; 
}

.top-bar-section ul li a {
  color: #fff; 
  text-decoration: none; 
  padding: 10px 20px; 
  transition: background-color 0.3s; 
  border-radius: 5px; 
}

.top-bar-section ul li a:hover,
.top-bar-section ul li.active a {
  background-color: #9a1e1e;
}

@media only screen and (max-width: 768px) {
  .top-bar .top-bar-section {
    display: none;
    flex-direction: column;
    cursor: pointer;
    padding: 10px;
    background: #333;
    color: #fff;
    border: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .top-bar .toggle-topbar {
    display: block;
  }

  .top-bar .toggle-topbar.menu-icon a {
    display: block;
    padding: 10px;
    color: #fff;
  }

  .top-bar .toggle-topbar.menu-icon a span {
    display: block;
    width: 30px;
    height: 3px;
    background: #fff;
    position: relative;
    transition: background 0.3s ease;
  }

  .top-bar .toggle-topbar.menu-icon a span::before,
  .top-bar .toggle-topbar.menu-icon a span::after {
    content: "";
    display: block;
    width: 30px;
    height: 3px;
    background: #fff;
    position: absolute;
    transition: transform 0.3s ease;
  }

  .top-bar .toggle-topbar.menu-icon a span::before {
    top: -8px;
  }

  .top-bar .toggle-topbar.menu-icon a span::after {
    top: 8px;
  }

  .top-bar .show-menu {
    display: block;
    position: absolute;
    top: 60px;
    right: 0;
    background: #333;
    width: 100%;
    border-top: 1px solid #fff;
  }

  .top-bar .show-menu ul {
    list-style: none;
    padding: 0;
  }

  .top-bar .show-menu ul li {
    border-bottom: 1px solid #003300;
    margin: 0;
  }

  .top-bar .show-menu ul li a {
    display: block;
    padding: 10px;
    color: #fff;
    text-decoration: none;
  }

  .top-bar .show-menu ul li a:hover {
    background: #444;
  }
}


.registration-form {
    margin: 120px auto; 
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-width: 600px; 
}


.row {
    margin-bottom: 15px;
}


.registration-form input[type="text"],
.registration-form input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    font-size: 1em;
}


.registration-form label {
    font-size: 1em;
    color: #333;
    font-weight: bold;
}


.registration-form a {
    color: #004d00;
    text-decoration: none;
}


.registration-form a:hover {
    text-decoration: underline;
}


.form-button {
    background: #004d00; 
    border: none;
    color: #fff;
    font-family: 'Baskerville SC', serif;
    font-size: 1em;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
    width: 100%; 
    max-width: 200px; 
}


.form-button:hover {
    background-color: #003300; 
    transform: translateY(-2px);
}


.form-button:active {
    background-color: #002200; 
    transform: translateY(1px);
}


@media (max-width: 768px) {
    .registration-form {
        padding: 15px;
    }

    .registration-form input[type="text"],
    .registration-form input[type="password"],
    .form-button {
        font-size: 0.9em;
    }
}


footer {
  background-color: #003300;
  color: #fff;
  text-align: center;
  padding: 20px 0;
  margin-top: 20px;
  font-size: 0.9em;
}
      </style>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">Orefile General Dealer</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php

          if(isset($_SESSION['username'])){
            echo '<li><a href="account.php">My Account</a></li>';
            echo '<li><a href="logout.php">Log Out</a></li>';
          }
          else{
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li class="active"><a href="register.php">Register</a></li>';
          }
          ?>
        </ul>
      </section>
    </nav>

    <form method="POST" action="insert.php" class="registration-form">
      <div>
        <h1>Create an account!</h1>
      <p>Already have an account? <a href="login.php">Click Here</a></p>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="row">
                <div class="small-4 columns">
                  
                    <label for="fname">Full Name</label>
                </div>
                <div class="small-8 columns">
                    <input type="text" id="fname" placeholder=" " name="fname">
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <label for="address">Address</label>
                </div>
                <div class="small-8 columns">
                    <input type="text" id="address" placeholder=" " name="address">
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <label for="city">Village</label>
                </div>
                <div class="small-8 columns">
                    <input type="text" id="city" placeholder=" " name="city">
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <label for="username">Username</label>
                </div>
                <div class="small-8 columns">
                    <input type="text" id="username" placeholder="" name="username">
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <label for="password">Password</label>
                </div>
                <div class="small-8 columns">
                    <input type="password" id="password" name="password">
                </div>
            </div>
         
            <div class="row">
                <div class="small-4 columns">
                    <label for="password">Confirm Password</label>
                </div>
                <div class="small-8 columns">
                    <input type="password" id="password" name="password">
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <input type="submit" value="Register" class="form-button">
                    <input type="reset" value="Reset" class="form-button">
                </div>
            </div>
        </div>
    </div>
</form>


    <div class="row" style="margin-top:10px;">
      <div class="small-12">

      <footer>
           <p style="text-align:center; font-size:0.8em;">&copy; 2024 Mafikeng Digital Innovation Hub. All rights reserved.</p>
        </footer>

      </div>
    </div>




    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
