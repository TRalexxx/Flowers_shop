<?php
global $conn;
session_start();
include '../controller/config.php';

// Check if the user is an admin
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: admin.php');
    exit();
}

// Delete flower if the flower_id is provided in the URL
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $flower_id = $_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM flowers WHERE id = ?');
    $stmt->bind_param('i', $flower_id);

    if ($stmt->execute()) {
        $delete_success_message = "Flower deleted successfully!";
    } else {
        $delete_error_message = "Error deleting the flower: " . $stmt->error;
    }

    $stmt->close();
}

$flowers = getFlowers();
?>

<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1>Administrator Dashboard</h1>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <a href="add_flower.php" class="btn btn-success">Add New Flower</a>

    <?php if (isset($delete_success_message)): ?>
        <div class="alert alert-success mt-3" role="alert">
            <?php echo $delete_success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($delete_error_message)): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $delete_error_message; ?>
        </div>
    <?php endif; ?>

    <h2>Flower Inventory</h2>
    <div class="row">
        <?php foreach ($flowers as $flower): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $flower['image_url']; ?>" class="card-img-top" alt="<?php echo $flower['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                        <p class="card-text">Price: $<?php echo $flower['price']; ?></p>
                        <p class="card-text">Quantity: <?php echo $flower['quantity']; ?></p>
                        <a href="?delete=<?php echo $flower['id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS (at the end of the body to improve page load time) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>