<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cute Dropshipping Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #fbe7c6; /* Soft pastel background color */
            color: #333;
        }

        header {
            background-color: #ffcad4; /* Light pink header */
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #f4a9c8;
        }

        h1, h2, h3 {
            color: #ff6f91; /* Soft, inviting color */
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #ff6f91;
            font-weight: bold;
        }

        .product {
            border: 1px solid #f4a9c8;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            background-color: #fff;
            text-align: center;
        }

        button {
            background-color: #ffcad4;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff6f91;
        }

        footer {
            background-color: #ffcad4;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <header>
        <h1>SUDS AND SIPS</h1>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section id="home">
        <h2>Home</h2>
        <p>Discover amazing and adorable products at great prices. We ship directly to you from our suppliers.</p>
    </section>

    <section id="products">
        <h2>Products</h2>
        <div class="product">
            <img src="product1.jpg" alt="Product 1">
            <h3>Product 1</h3>
            <p>Description of Product 1.</p>
            <p>Price: $20.00</p>
            <button onclick="buyNow(2000)">Buy Now</button>
        </div>
        <div class="product">
            <img src="product2.jpg" alt="Product 2">
            <h3>Product 2</h3>
            <p>Description of Product 2.</p>
            <p>Price: $30.00</p>
            <button onclick="buyNow(3000)">Buy Now</button>
        </div>
    </section>

    <section id="about">
        <h2>About Us</h2>
        <p>We are a dedicated team passionate about bringing you the cutest products from around the world.</p>
    </section>

    <section id="contact">
        <h2>Contact</h2>
        <form action="/submit-form" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <br>
            <button type="submit">Send Message</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 My Cute Dropshipping Store. All rights reserved.</p>
    </footer>

    <script>
        const stripe = Stripe('YOUR_STRIPE_PUBLIC_KEY'); // Replace with your Stripe public key

        function buyNow(amount) {
            fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ amount })
            })
            .then(response => response.json())
            .then(data => {
                stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                        card: elements.getElement(CardElement),
                        billing_details: {
                            name: 'Customer Name',
                        }
                    }
                }).then(result => {
                    if (result.error) {
                        console.error(result.error.message);
                    } else {
                        console.log('Payment succeeded!', result.paymentIntent);
                        alert("Thank you for your purchase! Your item is on its way to you. 💖");
                    }
                });
            });
        }
    </script>
</body>
</html>
