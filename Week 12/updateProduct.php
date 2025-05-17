<?php
session_start();
include 'connection.php';

if (isset($_POST['update_product'])) {

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, quantity = ?, price = ? WHERE id = ?");
    $stmt->bind_param("sidi", $product_name, $quantity, $price, $product_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Product updated successfully!";
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: adminPanel.php");
    exit();
}
?>
