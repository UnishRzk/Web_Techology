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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f9f9f9;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        thead {
            background-color: #4c53af;
            color: white;
        }
        h1 {
            margin-top: 20px;
            font-size: 2rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            width: 90%;
            align-items: center;
        }
        .btn {
            padding: 12px 24px;
            margin-top: 20px;

            font-size: 16px;
            background-color: #4c53af;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn:hover {
            background-color: #3a439f;
            transform: scale(1.05);
        }
        .product-name {
            text-align: left;
            padding-left: 15px;
        }

        
        .modal {
            display: none; 
            position: fixed;
            z-index: 1; 
            background-color: rgba(0, 0, 0, 0.5); 
            height: 100%;
            width: 100%;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
        }

        .modal-header {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .modal input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal button {
            width: 100%;
            padding: 10px;
            background-color: #4c53af;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .modal button:hover {
            background-color: #3a439f;
        }

        .success-message {
    color: green;
    padding: 10px;
    text-align: center;
}

.error-message {
    color: red;
    padding: 10px;
    text-align: center;
}
    </style>
</head>
<body>

    <div style="width: 90%; margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
    </div>
    <div>
        <a href="logout.php" style="text-decoration: none;">
            <button class="btn">Logout</button>
        </a>
    </div>
    </div>


    <div class="header">
        <h1>Product List</h1>
    <div class="button">
        <button class="add-product btn" id ="add-product" onclick="openModal()"> Add Products </button>
        <button class="del-product btn" id ="del-product" onclick="openDeleteModal()"> Delete Products </button>
        <button class="update-product btn" id ="update-product" onclick="openUpdateModal()"> Update Products </button>
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
