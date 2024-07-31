
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OREFILE GENERAL STORE - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
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

        .recent-activity, .payment-section, .order-section {
            margin-top: 30px;
            background-color: #3c3c3c;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .recent-activity h2, .payment-section h2, .order-section h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .recent-activity table, .payment-section table, .order-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .recent-activity th, .recent-activity td, .payment-section th, .payment-section td, .order-section th, .order-section td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #555;
        }

        .recent-activity th, .payment-section th, .order-section th {
            background-color: #444;
        }

        .recent-activity tr:hover, .payment-section tr:hover, .order-section tr:hover {
            background-color: #555;
        }

        .add-payment-btn, .add-order-btn {
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-form, .order-form {
            display: none;
            margin-bottom: 20px;
        }

        .payment-form input, .payment-form select, .order-form input, .order-form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #444;
            color: white;
        }

        .payment-form button, .order-form button {
            padding: 10px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .category-section {
            margin-top: 30px;
            background-color: #3c3c3c;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .category-section h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="store-name">OREFILE GENERAL STORE</div>
        <div class="nav-links">
            <a href="#dashboard">Dashboard</a>
            <div class="dropdown-btn">Orders</div>
            <div class="dropdown-container">
                <a href="#order-section">View Orders</a>
                <a href="#add-order">Add Order</a>
            </div>
            <div class="dropdown-btn">Payments</div>
            <div class="dropdown-container">
                <a href="#payment-section">View Payments</a>
                <a href="#add-payment">Add Payment</a>
            </div>
            <div class="dropdown-btn">Products</div>
            <div class="dropdown-container">
                <a href="#fruits-vegetables">Fruits & Vegetables</a>
                <a href="#dairy-products">Dairy Products</a>
                <a href="#baked-goods">Baked Goods</a>
                <a href="#beverages">Beverages</a>
                <a href="#snacks">Snacks</a>
                <a href="#household-items">Household Items</a>
                <a href="#personal-care">Personal Care</a>
            </div>
            <a href="#customers">Customers</a>
            <a href="#reports">Reports</a>
            <a href="#settings">Settings</a>
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
                <img src="img/user.png" alt="Admin Profile Picture">
            </div>
        </div>

        <div class="dashboard-widgets">
            <div class="widget">
                <h3>Total Products</h3>
                <p>120</p>
            </div>
            <div class="widget">
                <h3>Orders Today</h3>
                <p>35</p>
            </div>
            <div class="widget">
                <h3>Customers</h3>
                <p>1500</p>
            </div>
            <div class="widget">
                <h3>Sales Today</h3>
                <p>$550.00</p>
            </div>
        </div>

        <div class="recent-activity">
            <h2>Recent Activity</h2>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>2024-07-30</td>
                    <td>Order #1001</td>
                    <td>Completed</td>
                </tr>
                <tr>
                    <td>2024-07-30</td>
                    <td>Payment #456</td>
                    <td>Completed</td>
                </tr>
                <tr>
                    <td>2024-07-30</td>
                    <td>Order #1002</td>
                    <td>Pending</td>
                </tr>
            </table>
        </div>

        <div class="order-section" id="order-section">
            <h2>Orders</h2>
            <button class="add-order-btn">Add Order</button>
            <div class="order-form">
                <input type="text" placeholder="Customer Name">
                <input type="text" placeholder="Product">
                <input type="number" placeholder="Quantity">
                <select>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
                <button>Add Order</button>
            </div>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>1001</td>
                    <td>John Doe</td>
                    <td>Completed</td>
                    <td><button>View</button></td>
                </tr>
                <tr>
                    <td>1002</td>
                    <td>Jane Smith</td>
                    <td>Pending</td>
                    <td><button>View</button></td>
                </tr>
            </table>
        </div>

        <div class="payment-section" id="payment-section">
            <h2>Payments</h2>
            <button class="add-payment-btn">Add Payment</button>
            <div class="payment-form">
                <input type="text" placeholder="Customer Name">
                <input type="text" placeholder="Payment Method">
                <input type="number" placeholder="Amount">
                <button>Add Payment</button>
            </div>
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>456</td>
                    <td>John Doe</td>
                    <td>$100.00</td>
                    <td><button>View</button></td>
                </tr>
                <tr>
                    <td>457</td>
                    <td>Jane Smith</td>
                    <td>$150.00</td>
                    <td><button>View</button></td>
                </tr>
            </table>
        </div>

        <div id="fruits-vegetables" class="category-section">
            <h2>Fruits & Vegetables</h2>
            <!-- Content for this category -->
        </div>
        <div id="dairy-products" class="category-section">
            <h2>Dairy Products</h2>
            <!-- Content for this category -->
        </div>
        <div id="baked-goods" class="category-section">
            <h2>Baked Goods</h2>
            <!-- Content for this category -->
        </div>
        <div id="beverages" class="category-section">
            <h2>Beverages</h2>
            <!-- Content for this category -->
        </div>
        <div id="snacks" class="category-section">
            <h2>Snacks</h2>
            <!-- Content for this category -->
        </div>
        <div id="household-items" class="category-section">
            <h2>Household Items</h2>
            <!-- Content for this category -->
        </div>
        <div id="personal-care" class="category-section">
            <h2>Personal Care</h2>
            <!-- Content for this category -->
        </div>
    </div>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }

        document.querySelector('.add-order-btn').addEventListener('click', function() {
            var orderForm = document.querySelector('.order-form');
            orderForm.style.display = orderForm.style.display === 'block' ? 'none' : 'block';
        });

        document.querySelector('.add-payment-btn').addEventListener('click', function() {
            var paymentForm = document.querySelector('.payment-form');
            paymentForm.style.display = paymentForm.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>
