<?php
session_start();
include 'connection.php';

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO products (product_name, quantity, price) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $product_name, $quantity, $price);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Product added successfully!";
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: adminPanel.php");
    exit();
}
?>