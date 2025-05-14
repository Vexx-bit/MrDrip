<?php
require_once './includes/config.php';

function displayProductSection($result) {
    global $conn;
    if ($result->num_rows > 0) {
        echo '<div class="product-grid">';
        while ($row = $result->fetch_assoc()) {
            $product_image = $row['product_image'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_id = $row['product_id'];

            echo '<div class="product-card" style="height:250px;">';
            echo '<img src="admin/product_images/' . $row['product_image'] . '" alt="' . $row['product_title'] . '" class="product-image">';
            echo '<div class="product-details">';
            echo '<p class="product-name">' . $row['product_title'] . '</p>';
            echo '<p class="product-description">' . $row['product_description'] . '</p>';
            echo '<p class="product-price">Kshs' . $row['product_price'] . '</p>';
            echo '<p class="product-original-price">Kshs' . $row['initial_price'] . '</p>';
            echo '<div class="modal-buttons">';
            echo '<form action="index.php" method="post">';
            echo '<input type="hidden" name="productId" value="' . $product_id . '">';
            echo '<input type="hidden" name="productName" value="' . $product_title . '">';
            echo '<input type="hidden" name="productPrice" value="' . $product_price . '">';
            echo '<input type="hidden" name="productImage" value="' . $product_image . '" style="">';
            echo '<button type="submit" class="modal-button" name="addToCart">Add to cart</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No products available.";
    }
}

// The following script handles the adding of the product to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addToCart'])) {
    if (isset($_POST['productId']) && isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productImage'])) {
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productImage = $_POST['productImage'];

        // Define the insertProductIntoCart function here
        function insertProductIntoCart($productId, $productName, $productPrice, $productImage) {
            global $conn;
            // Get the IP address of the user
            $ip = $_SERVER['REMOTE_ADDR'];

            // Prepare and execute the INSERT query
            $sql = "INSERT INTO cart (product_id, quantity, created_at, product_title, product_image, product_price, ip_address) VALUES ('$productId', 1, NOW(), '$productName', '$productImage', '$productPrice', '$ip')";
            
            if ($conn->query($sql)) {
                return true; // Insertion successful
            } else {
                return false; // Insertion failed
            }
        }

        if (insertProductIntoCart($productId, $productName, $productPrice, $productImage)) {
            
        } else {
            
        }
    }
}
?>
