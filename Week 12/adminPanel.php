<?php
     session_start();
     include 'connection.php';
     if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="adminpanel.css">
</head>
<body>

    <!-- Top Bar: Welcome + Buttons -->
<div class="top-bar">
  <div class="left">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
  </div>
  <div class="right">
    <a href="logout.php"><button class="btn logout">Logout</button></a>
    <button class="btn" onclick="openModal()">Add Products</button>
    <button class="btn" onclick="openDeleteModal()">Delete Products</button>
    <button class="btn" onclick="openUpdateModal()">Update Products</button>
  </div>
</div>

    
    <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
    ?>

    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);

                if(!$result){
                    die("Query failed: " . mysqli_error($conn));
                } else {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td class='product-name'>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>

    
     <!-- Add Product Modal -->
     <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add Product</h2>
            </div>
            <form action="addProduct.php" method="POST">
                <input type="text" name="product_name" placeholder="Product Name" required>
                <input type="number" name="quantity" placeholder="Quantity" required>
                <input type="number" name="price" placeholder="Price" required>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Delete Product</h2>
            </div>
            <form action="deleteProduct.php" method="POST">
                <input type="number" name="id" placeholder="Enter Product ID" required>
                <button type="submit" name="delete_product">Delete Product</button>
            </form>
        </div>
    </div>

    <!-- Update Product Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Product</h2>
            </div>
            <form action="updateProduct.php" method="POST">
            <input type="number" name="product_id" placeholder="Enter Product ID" required>
                <input type="text" name="product_name" placeholder="Product Name" required>
                <input type="number" name="quantity" placeholder="Quantity" required>
                <input type="number" name="price" placeholder="Price" required>
                <button type="submit" name="update_product">Update Product</button>
            </form>
        </div>
    </div>

<script>
function openModal() {
    document.getElementById("productModal").style.display = "flex";
}

function openDeleteModal() {
    document.getElementById("deleteModal").style.display = "flex";
}
function openUpdateModal() {
    document.getElementById("updateModal").style.display = "flex";
}
window.onclick = function(event) {
    if (event.target == document.getElementById("productModal")) {
        document.getElementById("productModal").style.display = "none";
    }
    if (event.target == document.getElementById("deleteModal")) {
        document.getElementById("deleteModal").style.display = "none";
    }
    if (event.target == document.getElementById("updateModal")) {
        document.getElementById("deleteModal").style.display = "none";
    }
}
</script>

</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
?>
