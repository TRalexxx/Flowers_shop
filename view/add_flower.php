<?php
global $conn;
session_start();
include '../controller/config.php';

if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare('INSERT INTO flowers (name, price, quantity, image_url) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('sdis', $name, $price, $quantity, $image_url);

    if ($stmt->execute()) {
        $success_message = "New flower added successfully!";
    } else {
        $error_message = "Error adding the new flower: " . $stmt->error;
    }

    $stmt->close();
}
?>

<html>
<head>
    <title>Add New Flower</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Add New Flower</h1>

    <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL:</label>
            <input type="url" name="image_url" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Flower</button>
    </form>
    <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Go Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>