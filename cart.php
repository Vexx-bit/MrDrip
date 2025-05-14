<?php
session_start();
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }
        .product_data {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
        }
        .deleteItem {
            background-color: hotpink;
            border: none;
        }
        .deleteItem i {
            color: white;
        }
        .input-qty {
            border: 1px solid hotpink;
            border-radius: 5px;
            padding: 5px;
            width: 40px;
        }
    </style>
    <title>Cart</title>
</head>
<body>
<div class="py-5">
    <div class="container">
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <?php
                            $sql = "SELECT * FROM cart";
                            $result = $conn->query($sql);
                            $count = $result->num_rows;

                            if ($count > 0) {
                                echo "<h2>$count Item(s)</h2>";
                            } else {
                                echo '<a href="index.php" class="btn btn-outline-primary">Continue Shopping</a>';
                                echo '<h2><i class="bx bxs-cart bx-lg" style="color: red;"></i> No items in your cart</h2>';
                            }
                            ?>
                        </div>
                        <div class="col-md-6 text-end">
                            <?php
                            if ($count > 0) {
                                echo '<a href="index.php" class="btn btn-outline-primary">Continue Shopping</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($count > 0) {
                echo '<div class="mycart">';
                $ip = $_SERVER['REMOTE_ADDR'];
                $cartItemsQuery = "SELECT * FROM cart WHERE ip_address ='$ip'";
                $cartItemsResult = $conn->query($cartItemsQuery);

                $totalPrice = 0; // Initialize total price variable

                while ($cartItem = $cartItemsResult->fetch_assoc()) {
                    $currentPrice = $cartItem['product_price'] * $cartItem['quantity'];

                    echo '<div class="card product_data shadow-sm mb-3">';
                    echo '<div class="row align-items-center d-flex">';
                            echo '<div class="col-md-2">';
                            echo '<img src="admin/product_images/' . $cartItem['product_image'] . '" alt="' . $cartItem['product_title'] . '" width="80px">';
                            echo '</div>';
                            echo '<div class="col-md-3">';
                            echo '<h5>' . $cartItem['product_title'] . '</h5>';
                            echo '</div>';
                            echo '<div class="col-md-3">';
                            echo '<h5 class="product-price" data-price="' . $cartItem['product_price'] . '">Kshs ' . number_format($currentPrice, 2) . '</h5>';
                            echo '</div>';
                            echo '<div class="col-md-2">';
                            echo '<input type="hidden" class="prodid" value="' . $cartItem['product_id'] . '">';
                            echo '<div class="input-group mb-3">';
                            echo '<button class="input-group-text decrement-btn updateQty">-</button>';
                            echo '<input type="text" class="form-control text-center input-qty bg-white" value="' . $cartItem['quantity'] . '">';
                            echo '<button class="input-group-text increment-btn updateQty">+</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-md-2">';
                            echo '<form method="post" action="remove_from_cart.php" onsubmit="return confirm(\'Are you sure you want to remove this product from the cart?\');">';
                            echo '<input type="hidden" name="product_id" value="' . $cartItem['product_id'] . '">';
                            echo '<button type="submit" class="btn btn-danger btn-sm deleteItem" style="margin-bottom: 13px;">';
                            echo '<i class="bx bx-trash"></i> Remove</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                    echo '</div>';

                    // Update total price
                    $totalPrice += $currentPrice;
                }

                echo '</div>';

                // Proceed to checkout button
                echo '<div class="float-end">';
                echo '<h4>Total Price: Kshs <span id="totalPrice">' . number_format($totalPrice, 2) . '</span></h4>';
                echo '<form method="post" action="checkout.php">';
                $cartItemsResult->data_seek(0); // Reset the result pointer
                while ($cartItem = $cartItemsResult->fetch_assoc()) {
                    echo '<input type="hidden" name="quantity[' . $cartItem['product_id'] . ']" value="' . $cartItem['quantity'] . '">';
                }
                echo '<button type="submit" class="btn btn-outline-primary">Proceed to Checkout</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const updateQtyButtons = document.querySelectorAll(".updateQty");

    updateQtyButtons.forEach(button => {
        button.addEventListener("click", () => {
            const productCard = button.closest(".product_data");
            const inputQty = productCard.querySelector(".input-qty");
            const priceElement = productCard.querySelector(".product-price");
            const productPrice = parseFloat(priceElement.dataset.price);
            const totalPriceElement = document.getElementById("totalPrice"); // Add this line

            let qty = parseInt(inputQty.value);

            if (button.classList.contains("increment-btn")) {
                qty++;
            } else if (button.classList.contains("decrement-btn")) {
                if (qty > 1) {
                    qty--;
                }
            }

            inputQty.value = qty;

            // Update the current price based on the new quantity
            const currentPrice = (productPrice * qty).toFixed(2);
            priceElement.textContent = `Kshs ${currentPrice}`;
            
            // Update the total price
            const totalProducts = <?php echo $totalPrice; ?>;
            const newTotalPrice = (totalProducts + parseFloat(currentPrice)).toFixed(2);
            totalPriceElement.textContent = newTotalPrice;
        });
    });
});
</script>

</body>
</html>
