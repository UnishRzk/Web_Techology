<?php
session_start();
include 'connection.php';

if (isset($_POST['delete_product'])) {
    $product_ID = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_ID);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['success_message'] = "Product deleted successfully!";
        } else {
            $_SESSION['error_message'] = "Error: No product found with that ID.";
        }
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: adminPanel.php");
    exit();
}
?>