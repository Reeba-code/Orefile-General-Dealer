<?php
session_start(); 
include 'config.php'; 
include 'components/connect.php'; 
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskerville+SC:wght@400;700&display=swap" rel="stylesheet">
    <title>Products </title>
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
                flex-direction: column;
                cursor: pointer;
                padding: 10px;
                background: #333;
                color: #fff;
                position: absolute;
                top: 60px;
                right: 0;
            }

            .top-bar .toggle-topbar {
                display: block;
            }
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin: 0 auto;
            padding: 20px;
            max-width: 1200px;
        }

        .product-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 300px;
            flex: 1 1 300px;
            text-align: center;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-top: 100px;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .add-to-cart-btn {
            background-color: #003300;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1em;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .add-to-cart-btn:hover {
            background-color: #9a1e1e;
        }

        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #9a1e1e;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .view-cart-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #003300;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: none;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view-cart-btn i {
            margin-right: 10px;
        }

        @media (min-width: 768px) {
            .product-card {
                flex: 1 1 calc(15% - 20px);
                max-width: 100%;
            }
            .product img {
                width: 100%;
                height: auto;
                display: block;
            }
        }

        @media (max-width: 767px) {
            .product-card {
                flex: 1 1 calc(50% - 20px);
            }
        }

        .footer {
            background-color: #003300;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 100px;
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
    </style>
</head>
<body>

<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="index.php">Orefile General Dealer</a></h1>
        </li>
        <li class="toggle-topbar menu-icon">
            <a href="#"><span></span></a>
        </li>
    </ul>

    <section class="top-bar-section">
        <ul class="right">
            <li><a href="about.php">About</a></li>
            <li class='active'><a href="products.php">Shop</a></li>
            <li><a href="cart.php">View Cart</a></li>
            <li><a href="orders.php">My Orders</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            if (isset($_SESSION['username'])) {
                echo '<li><a href="account.php">My Account</a></li>';
                echo '<li><a href="logout.php">Log Out</a></li>';
            } else {
                echo '<li><a href="login.php">Log In</a></li>';
                echo '<li><a href="register.php">Register</a></li>';
            }
            ?>
        </ul>
    </section>
</nav>
<div class="notification" id="notification">Item added to cart!</div>
    <button class="view-cart-btn" id="viewCartBtn">View Cart</button>

    <div class="product-grid">
        <?php
        $result = $mysqli->query('SELECT * FROM products');
        if($result){
            while($obj = $result->fetch_object()) {
                echo '<div class="product-card">';
                echo '<h3>'.$obj->product_name.'</h3>';
                echo '<img src="images/products/'.$obj->product_img_name.'"/>';
                echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
                echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
                echo '<p><strong>Units Available</strong>: '.$obj->qty.'</p>';
                echo '<p><strong>Price (Per Unit)</strong>: '.$currency.$obj->price.'</p>';

                if($obj->qty > 0){
                    echo '<a href="update-cart.php?action=add&id='.$obj->id.'" class="add-to-cart-btn" onclick="addToCart(event)">Add To Cart</a>';
                } else {
                    echo '<p class="out-of-stock">Out Of Stock!</p>';
                }
                
                echo '</div>';
            }
        }
        ?>
    </div>

<div class="footer">
    <div class="footer-content">
        <ul class="footer-links">
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>
</div>
<script>     
   function addToCart(event) {
            event.preventDefault(); 
            const url = event.target.href;

            fetch(url)
                .then(response => {
                    if (response.ok) {
                        showNotification();
                    }
                });

            document.getElementById('viewCartBtn').style.display = 'block';
        }

        function showNotification() {
            const notification = document.getElementById('notification');
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 2000); 
        }

        document.getElementById('viewCartBtn').addEventListener('click', function() {
            window.location.href = 'cart.php'; 
        });
</script>
</body>
</html>
