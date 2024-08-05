<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OREFILE GENERAL STORE - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #2b2b2b;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            background-color: #4caf50;
            color: white;
            width: 250px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar .store-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar .nav-links {
            width: 100%;
        }

        .sidebar .nav-links a, .dropdown-btn {
            display: block;
            padding: 15px;
            text-align: left;
            text-decoration: none;
            color: white;
            font-size: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
        }

        .sidebar .nav-links a:hover, .dropdown-btn:hover {
            background-color: #81c784;
        }

        .dropdown-container {
            display: none;
            background-color: #1e7b32;
            padding-left: 8px;
        }

        .dropdown-container a {
            padding: 10px;
            padding-left: 40px;
            text-decoration: none;
            color: white;
            display: block;
            border-bottom: none;
        }

        .dropdown-container a:hover {
            background-color: #66bb6a;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .header {
            background-color: #333;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            color: white;
        }

        .header .search-bar {
            display: flex;
            align-items: center;
        }

        .header .search-box {
            padding: 5px 10px;
            border: 1px solid #a5d6a7;
            border-radius: 20px;
            margin-right: 10px;
            outline: none;
            background-color: #444;
            color: white;
        }

        .header .search-btn {
            padding: 5px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .header .profile {
            display: flex;
            align-items: center;
        }

        .header .profile img {
            border-radius: 50%;
            margin-left: 10px;
            width: 40px;
            height: 40px;
        }

        .dashboard-widgets {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .widget {
            background-color: #3c3c3c;
            border-radius: 10px;
            padding: 20px;
            width: 23%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .widget h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .widget p {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .recent-activity, .order-section, .payment-section, .stock-section {
            margin-top: 30px;
            background-color: #3c3c3c;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .recent-activity h2, .order-section h2, .payment-section h2, .stock-section h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .recent-activity table, .order-section table, .payment-section table, .stock-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .recent-activity th, .recent-activity td, .order-section th, .order-section td, .payment-section th, .payment-section td, .stock-section th, .stock-section td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #555;
        }

        .recent-activity th, .order-section th, .payment-section th, .stock-section th {
            background-color: #444;
        }

        .recent-activity tr:hover, .order-section tr:hover, .payment-section tr:hover, .stock-section tr:hover {
            background-color: #555;
        }

        .add-payment-btn, .add-order-btn, .add-stock-btn {
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-form, .order-form, .stock-form {
            display: none; /* Hide by default */
            margin-bottom: 20px;
        }

        .payment-form input, .payment-form select, .order-form input, .order-form select, .stock-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #444;
            color: white;
        }

        .payment-form button, .order-form button, .stock-form button {
            padding: 10px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .category-section {
            display: none;
        }

        .back-btn {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="store-name">OREFILE GENERAL STORE</div>
        <div class="nav-links">
            <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <div class="dropdown-btn"><i class="fas fa-box"></i> Orders</div>
            <div class="dropdown-container">
                <a href="#order-section"><i class="fas fa-list"></i> View Orders</a>
                <a href="#order-section" class="add-order-btn"><i class="fas fa-plus"></i> Add Order</a>
            </div>
            <div class="dropdown-btn"><i class="fas fa-credit-card"></i> Payments</div>
            <div class="dropdown-container">
                <a href="#payment-section"><i class="fas fa-list"></i> View Payments</a>
                <a href="#payment-section" class="add-payment-btn"><i class="fas fa-plus"></i> Add Payment</a>
            </div>
            <div class="dropdown-btn"><i class="fas fa-cubes"></i> Products</div>
            <div class="dropdown-container">
                <a href="#fruits-vegetables"><i class="fas fa-apple-alt"></i> Fruits & Vegetables</a>
                <a href="#dairy-products"><i class="fas fa-cheese"></i> Dairy Products</a>
                <a href="#baked-goods"><i class="fas fa-bread-slice"></i> Baked Goods</a>
                <a href="#beverages"><i class="fas fa-cocktail"></i> Beverages</a>
                <a href="#snacks"><i class="fas fa-cookie"></i> Snacks</a>
                <a href="#household-items"><i class="fas fa-broom"></i> Household Items</a>
                <a href="#personal-care"><i class="fas fa-hand-sparkles"></i> Personal Care</a>
            </div>
            <div class="dropdown-btn"><i class="fas fa-cubes"></i> Stock</div>
            <div class="dropdown-container">
                <a href="#stock-section"><i class="fas fa-boxes"></i> View Stock</a>
                <a href="#stock-section" class="add-stock-btn"><i class="fas fa-plus"></i> Add Stock</a>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <input type="text" class="search-box" placeholder="Search...">
                <button class="search-btn">Search</button>
            </div>
            <div class="profile">
                <span>Admin</span>
                <img src="profile-pic.jpg" alt="Profile Picture">
            </div>
        </div>

        <div class="dashboard-widgets">
            <div class="widget">
                <h3>Total Sales</h3>
                <p>R1,234</p>
            </div>
            <div class="widget">
                <h3>Total Orders</h3>
                <p>567</p>
            </div>
            <div class="widget">
                <h3>Total Payments</h3>
                <p>R890</p>
            </div>
            <div class="widget">
                <h3>Total Stock</h3>
                <p>234 items</p>
            </div>
        </div>

        <div class="recent-activity" id="recent-activity">
            <h2>Recent Activity</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>1001</td>
                    <td>2024-07-30</td>
                    <td>John Doe</td>
                    <td>Completed</td>
                </tr>
                <!-- Additional rows as needed -->
            </table>
        </div>

        <div class="order-section" id="order-section">
            <button class="back-btn" onclick="goBack('order-section')">Back</button>
            <h2>Order Management</h2>
            <div class="order-form">
                <input type="text" id="order-customer-name" placeholder="Customer Name">
                <input type="text" id="order-product" placeholder="Product">
                <input type="number" id="order-quantity" placeholder="Quantity">
                <button onclick="addOrder()">Add Order</button>
            </div>
            <div class="order-list">
                <h3>Order List</h3>
                <table id="order-table">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                    <!-- Order rows will be dynamically added here -->
                </table>
            </div>                                                        
        </div>

        <div class="payment-section" id="payment-section">
            <button class="back-btn" onclick="goBack('payment-section')">Back</button>
            <h2>Payment Management</h2>
            <div class="payment-form">
                <input type="text" id="payment-customer-name" placeholder="Customer Name">
                <input type="number" id="payment-amount" placeholder="Amount">
                <select id="payment-method">
                    <option value="">Select Payment Method</option>
                    <option value="credit-card">Credit Card</option>
                    <option value="cash">Cash</option>
                    <option value="bank-transfer">Bank Transfer</option>
                </select>
                <button onclick="addPayment()">Add Payment</button>
            </div>
            <div class="payment-list">
                <h3>Payment List</h3>
                <table id="payment-table">
                    <tr>
                        <th>Payment ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Method</th>
                    </tr>
                    <!-- Payment rows will be dynamically added here -->
                </table>
            </div>
        </div>

        <div class="stock-section" id="stock-section">
            <button class="back-btn" onclick="goBack('stock-section')">Back</button>
            <h2>Stock Management</h2>
            <div class="stock-form">
                <input type="text" id="stock-product-name" placeholder="Product Name">
                <input type="number" id="stock-quantity" placeholder="Quantity">
                <button onclick="addStock()">Add Stock</button>
            </div>
            <div class="stock-list">
                <h3>Stock List</h3>
                <table id="stock-table">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                    <!-- Stock rows will be dynamically added here -->
                </table>
            </div>
        </div>
    </div>

    <script>
        // Example stock data
        let stockData = [
            { name: 'Apple', quantity: 50 },
            { name: 'Milk', quantity: 30 },
            { name: 'Bread', quantity: 20 }
        ];

        function updateStockTable() {
            const stockTable = document.getElementById('stock-table');
            stockTable.innerHTML = `
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            `;

            stockData.forEach(stock => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${stock.name}</td>
                    <td>${stock.quantity}</td>
                `;
                stockTable.appendChild(row);
            });
        }

        function addStock() {
            const productName = document.getElementById('stock-product-name').value;
            const quantity = parseInt(document.getElementById('stock-quantity').value, 10);

            if (productName && quantity > 0) {
                stockData.push({ name: productName, quantity: quantity });
                updateStockTable();
                document.getElementById('stock-product-name').value = '';
                document.getElementById('stock-quantity').value = '';
            } else {
                alert('Please provide valid product name and quantity.');
            }
        }

        function goBack(sectionId) {
            document.getElementById(sectionId).style.display = 'none';
            document.getElementById('dashboard').style.display = 'block';
        }

        // Initialize
        updateStockTable();

        // Toggle visibility of sections
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', function() {
                const container = this.nextElementSibling;
                container.style.display = container.style.display === 'block' ? 'none' : 'block';
            });
        });

        document.querySelector('.add-order-btn').addEventListener('click', function() {
            document.getElementById('order-section').style.display = 'block';
            document.getElementById('payment-section').style.display = 'none';
            document.getElementById('stock-section').style.display = 'none';
        });

        document.querySelector('.add-payment-btn').addEventListener('click', function() {
            document.getElementById('payment-section').style.display = 'block';
            document.getElementById('order-section').style.display = 'none';
            document.getElementById('stock-section').style.display = 'none';
        });

        document.querySelector('.add-stock-btn').addEventListener('click', function() {
            document.getElementById('stock-section').style.display = 'block';
            document.getElementById('order-section').style.display = 'none';
            document.getElementById('payment-section').style.display = 'none';
        });
    </script>
</body>
</html>
