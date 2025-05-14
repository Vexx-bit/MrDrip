<?php
session_start();
require_once './includes/config.php';

// Retrieve orders data from the database
$userEmail = $_SESSION['email'];
$sql = "SELECT * FROM orders WHERE user_email = '$userEmail' ";
$result = mysqli_query($conn, $sql);

// Check if there are any orders
if (mysqli_num_rows($result) > 0) {
    $ordersData = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $ordersData = array(); // Empty array if no orders found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include Boxicons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* Add CSS for styling the My Orders page */
body {
    background-color: #f7f7f7;
    font-family: Arial, sans-serif;
}

.container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: hotpink;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: hotpink;
    border: none;
}

.btn-primary:hover {
    background-color: #ff69b4;
    border: none;
}

.table {
    background-color: #fff;
}

.table th {
    background-color: hotpink;
    color: white;
}

.table th, .table td {
    vertical-align: middle;
}

.table img {
    max-width: 100px;
}

.btn-success, .btn-danger {
    margin-right: 5px;
}

@media (max-width: 768px) {
    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
    }
}

    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>My Orders</h2>
        <a href="index.php" class="btn btn-primary mb-3"><i class="bx bx-arrow-back"></i> Back to Home</a>

        <?php if (!empty($ordersData)): ?>
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Product Image</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordersData as $order): ?>
                        <tr>
                            <td><?php echo $order['invoice_number']; ?></td>
                            <td>
                                <img src="admin/product_images/<?php echo $order['product_image']; ?>"
                                     
                                     width="100">
                            </td>
                            <td>Kshs <?php echo $order['total_price']; ?></td>
                            <td>
                                <a href='confirm_payment.php?order_id=<?php echo $order['order_id']; ?>' class="btn btn-success" title="Confirm Order"><i class="bx bx-check"></i> Confirm</a>
                                <a class="btn btn-danger" title="Delete Order"><i class="bx bx-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                    </div>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap and Boxicons scripts if needed -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/js/boxicons.min.js"></script> -->
</body>
</html>
