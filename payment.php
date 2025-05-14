<?php
session_start();
require_once 'includes/config.php';

if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Retrieve product information from the database
    $product_query = "SELECT * FROM products WHERE product_id = $product_id";
    $product_result = mysqli_query($conn, $product_query);

    if (mysqli_num_rows($product_result) === 1) {
        $product_data = mysqli_fetch_assoc($product_result);
        $invoice_number = $product_data['invoice_number'];
        $amount_due = $product_data['price'];

        if(isset($_POST['submit'])) {
            $invoice_number = $_POST['invoice_number'];
            $amount = $_POST['amount'];
            $payment_mode = $_POST['payment_mode'];

            $insert_query = "INSERT INTO payments (product_id, invoice_number, amount, payment_mode) VALUES ($product_id, $invoice_number, $amount, '$payment_mode')";
            $result = mysqli_query($conn, $insert_query);

            if($result) {
                echo "<script>alert('Successfully completed the payment')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "Error processing payment: " . mysqli_error($conn);
            }
        }
    }
}
?>
