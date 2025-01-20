<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="css/foundation.css" />
</head>
<body>
    <div class="container">
        <h1>Thank you for your payment!</h1>
        <p>Your order has been processed successfully.</p>
        <p>Order Total: <?php echo $_SESSION['total_cost']; ?></p>
        <a href="orders.php" class="button">Track Yor Order</a>
    </div>
</body>
</html>
