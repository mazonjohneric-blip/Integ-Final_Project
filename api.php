<?php
include 'db.php';
header("Content-Type: application/json");

$stmt = $conn->query("SELECT * FROM products ORDER BY product_id DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>