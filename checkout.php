<?php
session_start();
include 'config.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$total = 0;

if (isset($_POST['update_cart'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $result = $mysqli->query("SELECT price FROM products WHERE id = $product_id");
            if ($result) {
                $product = $result->fetch_object();
                $cost = $product->price * $quantity;
                $total += $cost;
            }    
        }
    }
    echo $total;
    exit();  
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['payment_method'], FILTER_SANITIZE_STRING);
    $address = 'flat no. '. filter_var($_POST['flat'], FILTER_SANITIZE_STRING) .', '. 
               filter_var($_POST['street'], FILTER_SANITIZE_STRING) .', '. 
               filter_var($_POST['city'], FILTER_SANITIZE_STRING) .', '. 
               filter_var($_POST['state'], FILTER_SANITIZE_STRING) .', '. 
               filter_var($_POST['country'], FILTER_SANITIZE_STRING) .' - '. 
               filter_var($_POST['pin_code'], FILTER_SANITIZE_STRING);
    
    $user_id = $_SESSION['user_id'];

    if (!empty($_SESSION['cart'])) {
        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $total_products = array_sum($_SESSION['cart']);
        $total_price = 0; 
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
        $order_id = $conn->lastInsertId();

        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $result = $mysqli->query("SELECT price FROM products WHERE id = $product_id");
            if ($result) {
                $product = $result->fetch_object();
                $cost = $product->price * $quantity;
                $stmt = $mysqli->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('iiid', $order_id, $product_id, $quantity, $product->price);
                $stmt->execute();
                $total_price += $cost;
            }
        }

        $update_order = $conn->prepare("UPDATE orders SET total_price = ? WHERE id = ?");
        $update_order->execute([$total_price, $order_id]);
        unset($_SESSION['cart']);
        header("Location: payment.php");
        exit();
    } else {
        $message[] = 'Your cart is empty';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout || Orefile General Dealer</title>
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
            }

            .top-bar .toggle-topbar {
                display: block; 
            }

            .top-bar .toggle-topbar.menu-icon a span {
                display: block;
                width: 30px;
                height: 3px;
                background: #fff;
            }
        }

        .container {
            width: 80%;
            margin: 120px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            color: #666;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .total-row {
            font-weight: bold;
        }

        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input[type="text"], select, input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            background-color: #003300;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #9a1e1e;
        }

        #addressFields {
            margin-top: 20px;
        }

        .radio-buttons {
            margin-bottom: 20px;
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
            <li><a href="about.php">About</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="cart.php">View Cart</a></li>
            <li class="active"><a href="checkout.php">Checkout</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            if(isset($_SESSION['username'])){
                echo '<li><a href="account.php">My Account</a></li>';
                echo '<li><a href="logout.php">Log Out</a></li>';
            }
            ?>
        </ul>
    </section>
</nav>

<div class="container">
    <h2>Checkout</h2>

    <?php
    if(isset($_SESSION['cart'])) {
        $total = 0;
        echo '<table>';
        echo '<tr>';
        echo '<th>Code</th>';
        echo '<th>Name</th>';
        echo '<th>Quantity</th>';
        echo '<th>Cost</th>';
        echo '</tr>';

        foreach($_SESSION['cart'] as $product_id => $quantity) {
            $result = $mysqli->query("SELECT product_code, product_name, price FROM products WHERE id = $product_id");
            $product = $result->fetch_object();
            $cost = $product->price * $quantity;
            $total += $cost;

            echo '<tr>';
            echo '<td>' . $product->product_code . '</td>';
            echo '<td>' . $product->product_name . '</td>';
            echo '<td>' . $quantity . '</td>';
            echo '<td>' . $cost . '</td>';
            echo '</tr>';
        }
        echo '<tr><td colspan="3" class="total-row">Total: </td><td>' . $total . '</td></tr>';
        echo '</table>';
    }
    ?>

    <form method="POST">
        <h3>Billing Details</h3>
        <label for="name">Full Name</label>
        <input type="text" name="name" required>
        
        <label for="number">Mobile Number</label>
        <input type="tel" name="number" required>
        
        <label for="email">Email Address</label>
        <input type="text" name="email" required>
        
        <label for="payment_method">Payment Method</label>
        <select name="payment_method">
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
        </select>

        <div class="radio-buttons">
            <label><input type="radio" name="delivery_method" value="pickup"> Pickup</label>
            <label><input type="radio" name="delivery_method" value="delivery" checked> Delivery</label>
        </div>

        <div id="addressFields">
            <label for="flat">Flat/House Number</label>
            <input type="text" name="flat" required>

            <label for="street">Street</label>
            <input type="text" name="street" required>

            <label for="city">City</label>
            <input type="text" name="city" required>

            <label for="state">State</label>
            <input type="text" name="state" required>

            <label for="country">Country</label>
            <input type="text" name="country" required>

            <label for="pin_code">Pin Code</label>
            <input type="text" name="pin_code" required>
        </div>

        <input type="submit" name="order" value="Place Order" class="button">
    </form>
</div>

<div class="footer">
    <div class="footer-content">
        <ul class="footer-links">
            <li><a href="privacy-policy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms & Conditions</a></li>
        </ul>
    </div>
</div>
</body>
</html>
