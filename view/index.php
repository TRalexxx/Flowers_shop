<?php
session_start();
include '../controller/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $flower_id = $_POST['flower_id'];

    $flower = getFlowerById($flower_id);

    if ($flower) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][] = [
            'id' => $flower['id'],
            'name' => $flower['name'],
            'price' => $flower['price'],
        ];
    }
}

$flowers = getFlowers();
?>

<html>
<head>
    <title>Flower Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1>Welcome to the Flower Shop</h1>
    <form action="admin.php">
        <input type="submit" value="Admin Login">
    </form>

    <a href="view_cart.php" class="btn btn-primary mb-3">View Cart</a>

    <div class="row">
        <?php foreach ($flowers as $flower): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $flower['image_url']; ?>" class="card-img-top" alt="<?php echo $flower['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                        <p class="card-text">Price: $<?php echo $flower['price']; ?></p>
                        <form method="post" action="">
                            <input type="hidden" name="flower_id" value="<?php echo $flower['id']; ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>