<?php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = '';
$db_name = 'flower_shop';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getFlowers() {
    global $conn;
    $result = $conn->query('SELECT * FROM flowers');
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getFlowerById($flowerId) {
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM flowers WHERE id = ?');
    $stmt->bind_param('i', $flowerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $flower = $result->fetch_assoc();
    $stmt->close();
    return $flower;
}
function isAdmin($username, $password) {
    return $username === 'admin' && $password === 'admin';
}