<?php
session_start();
require_once 'includes/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];
        $updatedQuantities = $_POST['quantity'];


        // Initialize variables to calculate total price and invoice number
        $totalPrice = 0;
        $invoiceNumber = uniqid(); // Generating a unique invoice number

        foreach ($updatedQuantities as $productId => $quantity) {
            // Validate input (ensure quantity is a valid number, etc.)
            $quantity = intval($quantity);
            if ($quantity <= 0) {
                // Handle invalid quantity
                continue;
            }

            // Retrieve product details
            $productSql = "SELECT * FROM cart_update WHERE product_id = ?";
            $productStmt = $conn->prepare($productSql);
            $productStmt->bind_param("i", $productId);
            $productStmt->execute();
            $productResult = $productStmt->get_result();

            if ($productResult->num_rows > 0) {
                $product = $productResult->fetch_assoc();
                $productPrice = $product['product_price'];
                $productName = $product['product_title'];
                $productImage = $product['product_image'];

                // Calculate total price for this product
                $productTotalPrice = $productPrice * $quantity;
                $totalPrice += $productTotalPrice;

                // Insert order details into the order table
                // Insert order details into the order table
                $insertOrderSql = "INSERT INTO orders (user_email, product_image, product_title, total_price, order_date, invoice_number, quantity)
                VALUES (?, ?, ?, ?, NOW(), ?, ?)";
                $insertOrderStmt = $conn->prepare($insertOrderSql);
                $insertOrderStmt->bind_param("ssddsi", $userEmail, $productImage, $productName, $productTotalPrice, $invoiceNumber, $quantity);
                $insertOrderStmt->execute();


            }
        }

        // Clear the cart after successful checkout
        $clearCartSql = "DELETE FROM cart";
        if (!$conn->query($clearCartSql)) {
            // Handle cart clearing error
        }

        // Redirect to order success page with the invoice number
        header("Location: order_success.php?invoice=" . $invoiceNumber);
        exit;
    } else {
        echo "<script>window.open('login.php', '_self')</script>";
    }
}
?>
