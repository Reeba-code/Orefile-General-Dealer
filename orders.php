<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    
    header('Location: login.php');
    exit();
}


$host = "localhost";   
$dbname = "your_database"; 
$username = "root";  
$password = "";         

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}


$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .order-details {
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Your Orders</h1>

<?php if (count($orders) > 0): ?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Order Date</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
            <td><?php echo htmlspecialchars(number_format($order['total_amount'], 2)); ?></td>
            <td><?php echo htmlspecialchars($order['status']); ?></td>
            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="order-details">You have no orders yet.</p>
<?php endif; ?>

</body>
</html>
