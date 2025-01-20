<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'components/connect.php';


$message_id = isset($_SESSION['message_id']) ? $_SESSION['message_id'] : null;

$message_display = ''; 

if(isset($_POST['send'])){

   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

   
   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message_display = 'Already sent message!';
   } else {
    
      $insert_message = $conn->prepare("INSERT INTO `messages`(message_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$message_id, $name, $email, $number, $msg]);
      $message_display = 'Message sent successfully! Feedback will be provided soon!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   
 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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
    padding: 10px;
    background: #333;
    color: #fff;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  .top-bar .toggle-topbar {
    display: block;
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

  .top-bar .show-menu ul li {
    border-bottom: 1px solid #444;
  }

  .top-bar .show-menu ul li a:hover {
    background: #444;
  }
}

.contact {
    max-width: 600px;
    margin: 100px auto;
    padding: 20px;
    background: #fff;
    color: #000;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.box {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.box:focus {
    border-color: #007BFF;
    outline: none;
}

.btn {
    width: 100%;
    padding: 10px;
    background: #003300;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    transition: background 0.3s;
}

.btn:hover {
    background: #0056b3;
}

@media (max-width: 600px) {
    .contact {
        padding: 15px;
    }

    .box {
        font-size: 14px;
    }

    .btn {
        font-size: 14px;
    }
}

.footer {
    background-color:  #003300;
    color: #fff;
    text-align: center;
    padding: 20px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    display: inline;
    margin: 0 10px;
}
   </style>
</head>
<body>

<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="index.php">Orefile General Dealer</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>

    <section class="top-bar-section">
        <ul class="right">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="cart.php">View Cart</a></li>
            <li><a href="orders.php">My Orders</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="account.php">My Account</a></li>
                <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="login.php">Log In</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </section>
</nav>

<section class="contact">
    <form action="" method="post">
        <h3>Get in Touch</h3>
        <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
        <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
        <input type="number" name="number" min="0" max="9999999999" placeholder="Enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
        <textarea name="msg" class="box" placeholder="Enter your message" cols="30" rows="10" required></textarea>
        <input type="submit" value="Send Message" name="send" class="btn">
    </form>

    <?php if (!empty($message_display)): ?>
        <div class="message" style="text-align: center; color: green; margin-top: 20px;">
            <?php echo $message_display; ?>
        </div>
    <?php endif; ?>
</section>

<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 Mafikeng Digital Innovation Hub. All rights reserved.</p>
        <ul class="footer-links">
            <li><a href="about.php">About</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
        </ul>
    </div>
</footer>

<script>

document.querySelector('.toggle-topbar').addEventListener('click', function() {
  var menu = document.querySelector('.top-bar-section');
  if (menu.classList.contains('show-menu')) {
    menu.classList.remove('show-menu');
  } else {
    menu.classList.add('show-menu');
  }
});
</script>

</body>
</html>
