<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mrd";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['subcategory'])) {
    $subcategory = $_GET['subcategory'];

    // Fetch and display products based on the selected subcategory
    $productsQuery = "SELECT * FROM products WHERE product_subcategory = '$subcategory'";
    $productsResult = $conn->query($productsQuery);

    while ($productRow = $productsResult->fetch_assoc()) {
        echo '<div class="product-cad">';
        echo '<img src="admin/product_images/' . $productRow['product_image'] . '" alt="' . $productRow['product_title'] . '" class="product-imae">';
        echo '<p class="product-title">' . $productRow['product_title'] . '</p>';
        echo '<p class="product-desciption">' . $productRow['product_description'] . '</p>';
        echo '<p class="product-pice">Kshs' . $productRow['product_price'] . '</p>';
        echo '<form method="post" action="add_to_cart.php">';
        echo '<input type="hidden" name="product_id" value="' . $productRow['product_id'] . '">';
        echo '<input type="hidden" name="quantity" value="1">';
        echo '<button type="submit" class="add-to-cart-button">Add to Cart</button>';
        echo '</form>';
        echo '</div>';
    }
}

$conn->close();
