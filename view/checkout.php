<?php
session_start();
include '../controller/config.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your shopping cart is empty.";
    exit();
}

$cart = $_SESSION['cart'];
?>

<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1>Checkout</h1>
    <a href="index.php" class="btn btn-primary mb-3">Back to Shop</a>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>$<?php echo $item['price']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p>Total Price: $<?php echo array_sum(array_column($cart, 'price')); ?></p>


    <form method="post" action="complete_order.php">
        <button type="submit" class="btn btn-success">Complete Order</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>