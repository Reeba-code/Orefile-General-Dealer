
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TLAPENG DIGITAL TUCKSHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: rgb(30, 28, 28);
            margin: 0;
            font-family: 'Quicksand', sans-serif;
            color: white;
        }

        header {
            background-color: green;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            text-align: center;
        }

        .navbar li {
            display: inline;
        }

        .navbar li a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 18px 20px;
            text-decoration: none;
            font-family: 'Quicksand', sans-serif;
            font-size: 1.2em;
        }

        .navbar li a:hover {
            background-color: rgb(95, 255, 47);
        }

        .hero {
            text-align: center;
            padding: 50px 20px;
            background-color: rgb(40, 38, 38);
            border-bottom: 2px solid rgb(95, 255, 47);
        }

        .hero h1 {
            font-size: 3em;
            font-weight: bold;
            margin: 0;
        }

        .hero h3 {
            font-size: 1.5em;
            margin: 10px 0 30px;
        }

        .hero img {
            width: 80%;
            max-width: 600px;
            height: auto;
            margin: 20px 0;
            border-radius: 10px;
        }

        .overview {
            padding: 20px;
            text-align: center;
        }

        .overview h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .overview p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .featured-products {
            background-color: rgb(35, 33, 33);
            padding: 20px;
        }

        .product {
            display: inline-block;
            width: 30%;
            margin: 0 10px 20px;
            text-align: center;
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product h3 {
            margin: 10px 0;
            font-size: 1.5em;
        }

        .product p {
            font-size: 1.2em;
        }

        footer {
            background-color: green;
            padding: 20px 0;
            text-align: center;
        }

        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1;
            padding: 10px;
            min-width: 250px;
        }

        .footer-section h4 {
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .footer-section p, .footer-section a {
            font-size: 1em;
            color: white;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <ul>
                <li><a href="#Contact">Contact</a></li>
                <li><a href="#Services">Services</a></li>
                <li><a href="#About">About Us</a></li>
                <li><a href="#Home">Home</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>WELCOME TO TLAPENG DIGITAL TUCKSHOP</h1>
        <h3>Build the Future Today</h3>
        <img src="store.jpg" alt="Store Image">
    </section>

    <section class="overview">
        <h2>About Us</h2>
        <p>At Tlapeng Digital Tuckshop, we offer a wide range of products and services tailored to meet your everyday needs. From groceries to digital services, we've got you covered!</p>
    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product">
            <img src="product1.jpg" alt="Product 1">
            <h3>Product Name 1</h3>
            <p>Description of the product goes here.</p>
        </div>
        <div class="product">
            <img src="product2.jpg" alt="Product 2">
            <h3>Product Name 2</h3>
            <p>Description of the product goes here.</p>
        </div>
        <div class="product">
            <img src="product3.jpg" alt="Product 3">
            <h3>Product Name 3</h3>
            <p>Description of the product goes here.</p>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: info@tlapengtuckshop.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <p><a href="#">Facebook</a></p>
                <p><a href="#">Twitter</a></p>
                <p><a href="#">Instagram</a></p>
            </div>
        </div>
        <p>&copy; 2024 Tlapeng Digital Tuckshop. All rights reserved.</p>
    </footer>
</body>
</html>
