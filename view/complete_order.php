<?php
session_start();

unset($_SESSION['cart']);
?>

<html>
<head>
    <title>Order Complete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1>Order Complete</h1>
    <p>Thank you for your purchase!</p>
    <a href="index.php" class="btn btn-primary">Back to Shop</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>