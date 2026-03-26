<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");


$editData = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $resultEdit = $conn->query("SELECT * FROM products WHERE id=$id");
    $editData = $resultEdit->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Product Management</h2>

<form action="create.php" method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <input type="text" name="product_name" class="form-control mb-2"
        placeholder="Product Name"
        value="<?= $editData['product_name'] ?? '' ?>" required>

    <input type="number" name="price" class="form-control mb-2"
        placeholder="Price"
        value="<?= $editData['price'] ?? '' ?>" required>

    <textarea name="description" class="form-control mb-2"
        placeholder="Description"><?= $editData['description'] ?? '' ?></textarea>

    <button class="btn btn-success w-100">
        <?= $editData ? 'Update Product' : 'Add Product' ?>
    </button>
</form>

<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td>₱<?= $row['price'] ?></td>
            <td><?= $row['description'] ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>