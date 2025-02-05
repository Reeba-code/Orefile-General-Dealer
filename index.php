<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "shop_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    $stmt = $conn->prepare("SELECT DISTINCT product_category FROM products");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $predefinedCategories = ['sales', 'top picks', 'new'];

    $categories = array_unique(array_merge($predefinedCategories, $categories));

    if (empty($categories)) {
        $categories = []; 
    }

    $productsByCategory = [];
    foreach ($categories as $category) {
       
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = :category");
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        $productsByCategory[$category] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Orefile General Dealer</title>
    <link href="https://fonts.googleapis.com/css2?family=Baskerville+SC:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Baskerville SC', serif;
        margin: 0;
        padding: 0;
    }
    header nav {
        background-color: #003300;
        padding: 10px 0;
    }
    .navbar-brand, .nav-link {
        color: #fff;
        font-size: 1.2rem;
        font-weight: bold;
    }
    .nav-link:hover {
        color:  #9a1e1e; 
    }
    .btn-primary {
        background-color: #003300;
        border-color: #003300;
    }
    .btn-primary:hover {
        background-color: #002200;
        border-color: #002200;
    }
    .btn-success {
        background-color: #003300;
        border-color: #003300;
    }
    .btn-success:hover {
        background-color: #002200;
        border-color: #002200;
    }
    .product-item {
        border: 1px solid #e0e0e0;
        padding: 15px;
        margin: 10px;
        text-align: center;
        border-radius: 8px;
    }
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .menu-bar {
        display: flex;
        flex-wrap: wrap; 
        justify-content: space-around;
        padding: 15px;
        background-color: #9a1e1e;
        color: #fff;
    }

    @media (max-width: 768px) {
        .menu-bar {
            flex-direction: column;
            align-items: center; 
        }
        .menu-bar button {
            margin-bottom: 10px; 
            width: 90%; 
        }
    }
    
    .hero-list-group-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .hero-image {
        margin: 20px auto;
        width: 70%; 
        height: 500px;
        background-image: url('images/Cover.png');
        background-size: cover;
        background-position: center;
        border-radius: 10px;
    }
    @media (max-width: 768px){
        .hero-image{
            width: 90%;
            margin: 10px auto;
        }
    }
    .col-md-3 {
        margin-left: 20px; 
    }

    .footer {
        background-color: #003300;
        padding: 20px;
        text-align: center;
    }
</style>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Orefile General Dealer</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">View Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="orders.php">My Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item">
                            <button class="btn btn-success" onclick="toggleLoginOptions()">Login</button>
                            <div class="login-options" id="loginOptions" style="display: none;">
                                <button class="btn btn-outline-primary mt-2" onclick="login('user')">Login as User</button>
                                <button class="btn btn-outline-secondary mt-2" onclick="login('admin')">Login as Admin</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search for products, brands..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>

    <main class="container mt-5 pt-5">
        <div class="menu-bar">
            <button class="btn btn-outline-dark">ALOT For Less</button>
            <button class="btn btn-outline-dark">New to Orefile</button>
            <button class="btn btn-outline-dark">Deals & Promotions</button>
            <button class="btn btn-outline-dark">Month End</button>
            <button class="btn btn-outline-dark">Fresh Picks</button>
            <button class="btn btn-outline-dark">Brands Store</button>
            <button class="btn btn-outline-dark">Clearance</button>
        </div>

        <div class="hero-list-group-container">
            <div class="hero-image"></div>
            <div class="col-md-3">
                <h3>Categories</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#">Fruits</a></li>
                    <li class="list-group-item"><a href="#">Vegetables</a></li>
                    <li class="list-group-item"><a href="#">Dairy</a></li>
                    <li class="list-group-item"><a href="#">Snacks</a></li>
                </ul>
                <div class="mt-4">
                    <img src="images/PROMOTIONS AND SALES 2 (1).png" class="img-fluid" alt="Flash Sale">
                </div>
                <div class="mt-4">
                    <img src="images/PROMOTIONS AND SALES (1).jpg" class="img-fluid" alt="Flash Sale">
                </div>
            </div>
        </div>

        <div class="row mt-4">
    <div class="col-md-9">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <h2 class="mt-5"><?php echo ucfirst($category); ?> Products</h2>

                <div class="product-grid">
                    <?php if (!empty($productsByCategory[$category])): ?>
                        <?php foreach ($productsByCategory[$category] as $product): ?>
                            <div class="product-item">
                                <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                                <img src="images/products/<?php echo htmlspecialchars($product['product_img_name']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_desc']); ?>">
                                <p><?php echo htmlspecialchars($product['product_desc']); ?></p>
                                <p>Product Code: <?php echo htmlspecialchars($product['product_code']); ?></p>
                                <p>Price: R<?php echo number_format($product['price'], 2); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No products found in this category.</p>
                    <?php endif; ?>
                </div>
                <a href="category_page.php?category=<?php echo urlencode($category); ?>" class="btn btn-primary mt-3">View More</a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No categories available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

    </main>

    <footer class="footer mt-5">
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="index.php">Home</a></li>
                <li class="list-inline-item"><a href="about.php">About</a></li>
                <li class="list-inline-item"><a href="products.php">Products</a></li>
                <li class="list-inline-item"><a href="contact.php">Contact</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p>&copy; 2025 Orefile General Dealer | All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleLoginOptions() {
            const loginOptions = document.getElementById('loginOptions');
            loginOptions.style.display = (loginOptions.style.display === 'none') ? 'block' : 'none';
        }

        function login(userType) {
            if (userType === 'user') {
                window.location.href = 'user_login.php';
            } else if (userType === 'admin') {
                window.location.href = 'admin_login.php';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
