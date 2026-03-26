<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");

$id = $_POST['id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$description = $_POST['description'];

if ($id) {
    $sql = "UPDATE products SET 
            product_name='$product_name',
            price='$price',
            description='$description'
            WHERE id=$id";
} else {
    $sql = "INSERT INTO products (product_name, price, description)
            VALUES ('$product_name', '$price', '$description')";
}

$conn->query($sql);

header("Location: index.php");
?>