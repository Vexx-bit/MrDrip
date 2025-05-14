<?php
session_start();
require_once 'includes/config.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Retrieve user data from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

$userData = [];
if (mysqli_num_rows($result) === 1) {
    $userData = mysqli_fetch_assoc($result);
}

// Retrieve order history from the database
$order_query = "SELECT * FROM orders WHERE email = '$email'";
$order_result = mysqli_query($conn, $order_query);
?>

<!-- Display order history -->
<h1>Order History</h1>
<table>
    <tr>
        <th>Invoice Number</th>
        <th>Total Price</th>
        <th>Status</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($order_result)) : ?>
    <tr>
        <td><?php echo $row['invoice_number']; ?></td>
        <td><?php echo $row['total_price']; ?></td>
        <td><?php echo $row['order_status']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
