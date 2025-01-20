<?php


if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php'; 



?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart || Orefile General Dealer</title>
  </head>
  <style>
       
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
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

table {
    width: 80%;
    border-collapse: collapse;
    margin: 120px auto; 
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #003300;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    margin: 5px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.button.secondary {
    background-color: #006400; 
}

.button.success {
    background-color: #004d00; 
}

.button.alert {
    background-color: #b30000; 
}

.button:hover {
    opacity: 0.8;
}

.button:active {
    opacity: 0.6;
}


@media (max-width: 768px) {
    table {
        font-size: 14px;
    }
}

.footer {
    background-color: #003300;
    color: white;
    text-align: center;
    padding: 10px;
    margin-top: 173px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
}

.footer-links {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    display: inline;
    margin: 0 10px;
}

.footer-links a {
    color: white;
    text-decoration: none;
}

.footer-links a:hover {
    text-decoration: underline;
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
        <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li class="active"><a href="cart.php">View Cart</a></li>
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


    <div class="row" style="margin-top:10px;">
      <div class="large-12">
      <?php
  echo '<p><h3>Your Shopping Cart</h3></p>';

  if (isset($_SESSION['cart'])) {

    $total = 0;
    echo '<table>';
    echo '<tr>';
    echo '<th>Image</th>';
    echo '<th>Code</th>';
    echo '<th>Name</th>';
    echo '<th>Quantity</th>';
    echo '<th>Price</th>';
    echo '</tr>';

  
    foreach ($_SESSION['cart'] as $product_id => $quantity) {

  
      $result = $mysqli->query("SELECT product_code, product_name, product_desc, product_img_name, qty, price FROM products WHERE id = " . $product_id);

      if ($result) {
        while ($obj = $result->fetch_object()) {
          $cost = $obj->price * $quantity; 
          $total += $cost; 

          echo '<tr>';
          echo '<td><img src="images/products/' . $obj->product_img_name . '" style="width:100px; height:auto;"/></td>';
          echo '<td>' . $obj->product_code . '</td>';
          echo '<td>' . $obj->product_name . '</td>';
          echo '<td>' . $quantity . '&nbsp;<a class="button [secondary success alert]" style="padding:5px;" href="update-cart.php?action=add&id=' . $product_id . '">+</a>&nbsp;<a class="button alert" style="padding:5px;" href="update-cart.php?action=remove&id=' . $product_id . '">-</a></td>';
          echo '<td>' . $cost . '</td>';
          echo '</tr>';
        }
      }
    }

   
    echo '<tr>';
    echo '<td colspan="3" align="right"><b>Total</b></td>';
    echo '<td>' . $total . '</td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td colspan="4" align="right">';
    echo '<a href="update-cart.php?action=empty" class="button alert">Empty Cart</a>&nbsp;';
    echo '<a href="products.php" class="button [secondary success alert]">Continue Shopping</a>';

    if (isset($_SESSION['username'])) {
      echo '<a href="checkout.php"><button style="float:right; padding: 10px 20px; background-color: #003300; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; text-align: center; margin: 5px; transition: background-color 0.3s, transform 0.3s;">Checkout</button></a>';
    } else {
      echo '<a href="checkout.php"><button style="padding: 10px 20px; background-color: #003300; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; text-align: center; margin: 5px; transition: background-color 0.3s, transform 0.3s;">Checkout</button></a>';
    }

    echo '</td>';
    echo '</tr>';
    echo '</table>';
  } else {
    echo "You have no items in your shopping cart.";
  }

  echo '</div>';
  echo '</div>';
?>




    <div class="row" style="margin-top:10px;">
      <div class="small-12">


      <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Mafikeng Digital Innovation Hub. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
    </footer>

      </div>
    </div>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
      var modal = document.getElementById('emptyCartModal');
      var span = document.getElementsByClassName('close')[0];
      modal.style.display = 'block';
      
      span.onclick = function() {
        modal.style.display = 'none';
      }

      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      }
    <?php endif; ?>
  });
</script>


  </body>
</html>
