<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $_SESSION['order_type'] = $_POST['order_type'];
    $_SESSION['payment_method'] = $_POST['payment_method'];
    $_SESSION['total_cost'] = $_POST['total_cost'];

    if ($_POST['order_type'] == 'Delivery') {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['city'] = $_POST['city'];
       
    }
} else {
   
    header('Location: checkout.php');
    exit();
}
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Baskerville+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <title>Payment Information</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
<style>
   html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.container {
    flex: 1;
    max-width: 100%;
    width: 90%;
    max-width: 600px;
    padding: 20px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: auto; 
}

h2 {
    color: #333;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

input[type="text"], input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.button.success {
    background-color: #28a745;
    color: white;
    border: none;
    cursor: pointer;
}

.button.alert {
    background-color: #dc3545;
    color: white;
    border: none;
    cursor: pointer;
}

.button.success:hover, .button.alert:hover {
    opacity: 0.9;
}


footer {
    background-color: #004d00;
    text-align: center;
    padding: 20px 0;
    margin-top: auto;
}

footer p {
    margin: 0;
    color: #fff;
    font-size: 24px;
}


@media (max-width: 600px) {
    .container {
        width: 95%;
    }
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
     
        <ul class="right">
          <li class="active"><a href="about.php">About</a></li>
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
            echo '<li><a href="register.php">Register</a></li>';
          }
          ?>
        </ul>
      </section>
    </nav>

<div class="container">
    <div class="row" style="margin-top:20px;">
        <div class="large-12">
            <h2>Payment Information</h2>
            <p>Total Amount to Pay: <?php echo $_SESSION['total_cost']; ?></p>

            <?php
            $payment_method = $_SESSION['payment_method'];

            if ($payment_method == 'Credit Card') {
             
                ?>
<form action="success.php" method="POST" onsubmit="return validateForm()">
    <label for="cc_number">Credit Card Number:</label>
    <input type="text" name="cc_number" id="cc_number" placeholder="1234-5678-9012-3456" required>

    <label for="cc_expiry">Expiry Date:</label>
    <input type="text" name="cc_expiry" id="cc_expiry" placeholder="MM/YY" required>

    <label for="cc_cvv">CVV:</label>
    <input type="text" name="cc_cvv" id="cc_cvv" required>

    <input type="submit" value="Pay Now" class="button success">
</form>
<form action="cancel_order.php" method="POST">
    <input type="submit" value="Cancel Order" class="button alert">
</form>

  <?php
            } else {
                echo '<p>Invalid payment method selected.</p>';
            }
            ?>
        </div>
    </div>
    </div>

    
    <footer>
           <p style="text-align:center; font-size:0.8em;">&copy; 2024 Mafikeng Digital Innovation Hub. All rights reserved.</p>
        </footer>

        <script>
function validateForm() {
    const ccNumber = document.getElementById('cc_number').value;
    const ccExpiry = document.getElementById('cc_expiry').value;
    const ccCVV = document.getElementById('cc_cvv').value;

   
    const ccNumberPattern = /^(\d{4}-\d{4}-\d{4}-\d{4})$/;
    if (!ccNumberPattern.test(ccNumber)) {
        alert("Credit Card Number must be 16 digits separated by dashes (e.g., 1234-5678-9012-3456).");
        return false;
    }
 
    const ccExpiryPattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
    if (!ccExpiryPattern.test(ccExpiry)) {
        alert("Expiry Date must be in the format MM/YY (e.g., 12/24).");
        return false;
    }
    
  
    const ccCVVPattern = /^\d{3}$/;
    if (!ccCVVPattern.test(ccCVV)) {
        alert("CVV must be exactly 3 digits.");
        return false;
    }
    
    return true;
}


function formatCardNumber(input) {
  
    const value = input.value.replace(/\D/g, '');
    const formattedValue = value.match(/.{1,4}/g)?.join('-') || '';
    input.value = formattedValue;
}


document.addEventListener('DOMContentLoaded', function() {
    const ccNumberInput = document.getElementById('cc_number');
    ccNumberInput.addEventListener('input', function() {
        formatCardNumber(ccNumberInput);
    });
});
</script>



</body>
</html>

