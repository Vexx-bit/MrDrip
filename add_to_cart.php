<?php
require_once 'includes/config.php';
global $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Retrieve product details based on the product ID
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $productName = $row['product_title'];
        $productPrice = $row['product_price'];
        $productImage = $row['product_image'];
        $quantity = 1;

        // Insert the product into the cart table
        $insertSql = "INSERT INTO cart (product_id, product_title, product_price, product_image, quantity, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("isssd", $productId, $productName, $productPrice, $productImage, $quantity);

        if ($insertStmt->execute()) {
            echo '<script>window.open("index.php", "_self")</script>';
            exit;
        } 
    }
}
?>
