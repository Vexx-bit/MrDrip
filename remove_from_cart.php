<?php
session_start();
require_once 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Remove the product from the cart table
    $removeSql = "DELETE FROM cart WHERE product_id = ?";
    $removeStmt = $conn->prepare($removeSql);

    // Use "s" as the placeholder for the string product ID
    $removeStmt->bind_param("s", $productId);

    if ($removeStmt->execute()) {
        // Redirect back to the cart page after removal
        header("Location: cart.php");
        exit;
    } else {
        echo "Error removing product from cart: " . $removeStmt->error;
    }
}
?>
