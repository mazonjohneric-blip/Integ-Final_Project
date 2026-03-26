<?php
include 'db.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("UPDATE products SET product_name=?, price=?, description=? WHERE product_id=?");
$stmt->execute([
    $data['product_name'],
    $data['price'],
    $data['description'],
    $data['product_id']
]);

echo json_encode(["message" => "Product updated"]);
?>