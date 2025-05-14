<?php
session_start();
require_once '../includes/config.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}
$adminEmail = $_SESSION['admin_email'];

// Retrieve admin data from the database
$sql = "SELECT * FROM admins WHERE email = '$adminEmail'";
$result = mysqli_query($conn, $sql);

$adminName = "";
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $adminName = $row['full_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container-fluid {
            padding: 0;
        }

        .sidebar {
            background-color: #333;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: -200px;
            width: 200px;
            transition: left 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 20px;
        }

        .sidebar-links {
            list-style: none;
            padding: 0;
            margin-top: 5px;
        }

        .sidebar-links li {
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar-links li:hover {
            background-color: #444;
        }
        .sidebar-links li i{
            font-size: 30px;
        }

        .sidebar-close-button {
            position: absolute;
            bottom: 20px;
            left: calc(50% - 15px);
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            display: none;
            cursor: pointer;
        }

        .navbar {
            background-color: #007bff;
            color: #fff;
        }

        .navbar-brand {
            font-size: 24px;
        }

        .profile-dropdown {
            position: relative;
            cursor: pointer;
        }

        .profile-dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }

        @media (max-width: 767px) {
            .dashboard-card {
                width: calc(50% - 20px);
            }
        }
        #down-menu:hover{
            color: black;
        }
        #sticky-navbar {
    position: sticky;
    top: 0;
    z-index: 100;
}
    </style>
</head>
<body style="background-color: #fff;">
<nav class="navbar" id="sticky-navbar">
        <div class="container-fluid">
            <button class="btn btn-link text-white" id="sidebarToggle"><i class="bx bx-menu bx-lg"></i></button>
            <span class="navbar-brand"></span>
            <div class="profile-dropdown m-2">
                <span><?php echo strtok($adminName, ' '); ?><i class='bx bxs-down-arrow' style="font-size: 10px;" id="down-menu"></i></span>
                <div class="profile-dropdown-content align-content-center " style="background: #007bff;">
                    <a href="admin_logout.php" class="text-decoration-none text-light">Logout<i class='bx bx-exit text-dark' style="font-size: 19px;"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar" id="sidebar">
        <button class="btn btn-link text-white sidebar-close-button" id="sidebarClose"><i class="bx bx-x"></i></button>
        <div class="sidebar-header">
            <h3>Mr.D</h3>
        </div>
        <ul class="sidebar-links">
            <a class="text-decoration-none text-light" href="index.php"><li><i class="bx bx-home bx-md"></i> Dashboard</li></a>
            <a class="text-decoration-none text-light" href="men.php"><li><i class='bx bx-male'></i> Men</li></a>
            <a class="text-decoration-none text-light" href="women.php"><li><i class='bx bx-female'></i> Women</li></a>
            <a class="text-decoration-none text-light" href="kids.php"><li><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><circle cx="12" cy="6" r="2"></circle><path d="M14 9h-4a1 1 0 0 0-.8.4l-3 4 1.6 1.2L9 13v7h2v-4h2v4h2v-7l1.2 1.6 1.6-1.2-3-4A1 1 0 0 0 14 9z"></path></svg>kids</li></a>
            <a class="text-decoration-none text-light" href="display.php"><li><i class='bx bx-desktop'></i>Homepage</li></a>
            <a class="text-decoration-none text-light" href="orders.php"><li><i class="bx bx-cart bx-md"></i> Orders</li></a>
            <a class="text-decoration-none text-light" href="payments.php"><li><i class='bx bx-credit-card-alt'></i> Payments</li></a>
            <a class="text-decoration-none text-light" href="customers.php"><li><i class='bx bx-group'></i> Customers</li></a>
            <a class="text-decoration-none text-light" href="feedback.php"><li><i class='bx bx-envelope'></i>Feedbacks</li></a>
            <a class="text-decoration-none text-light" href="enquiries.php"><li><i class='bx bx-support'></i>Enquiries</li></a>
            <a class="text-decoration-none text-light" href="subscribers.php"><li><i class='bx bx-mail-send'></i>Subscribers</li></a>
            <a class="text-decoration-none text-light" href="add_admin.php"><li><i class='bx bx-user-plus'></i>Add admin</li></a>
        </ul>
    </div>
    <div class="container mt-5">
        <a href="display.php" class="btn btn-secondary mb-3">Back to Subcategories</a>
        
        <?php
        if (isset($_GET['delete_product'])) {
            $delete_product_id = $_GET['delete_product'];
        
            // Make sure $delete_product_id is an integer
            $delete_product_id = intval($delete_product_id);
        
            // Delete product from the database
            $delete_query = "DELETE FROM products WHERE product_id = ?";
            $stmt = mysqli_prepare($conn, $delete_query);
        
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $delete_product_id); // "i" for integer
                mysqli_stmt_execute($stmt);
        
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "<script>window.open('view_productsoffer.php?subcategory=" . urlencode($_GET['subcategory']) . "', '_self');</script>";
                    exit();
                }
        
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing delete query.";
            }
        }

        if (isset($_GET['subcategory'])) {
            $subcategory = $_GET['subcategory'];            
            $query = "SELECT * FROM products WHERE product_category = 'Popular'";
            $result_query = mysqli_query($conn, $query);

            while ($product = mysqli_fetch_assoc($result_query)) {
                echo "<h2>$product[product_category] - $product[product_subcategory]</h2>";
                echo '<div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="img-fluid rounded-start" src="./product_images/' . $product["product_image"] . '" alt="' . $product["product_title"] . ' image" width="auto" style="object-fit:contain;height:auto;">

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">' . $product['product_title'] . '</h5>
                                    <p class="card-text">Price: $' . $product['product_price'] . '</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal' . $product['product_id'] . '">Edit Details</button>
                                    <a href="?subcategory=' . urlencode($_GET['subcategory']) . '&delete_product=' . $product['product_id'] . '" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>';// Edit Modal
                    echo '<div class="modal fade" id="editModal' . $product['product_id'] . '" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Product Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="product_id" value="' . $product['product_id'] . '">
                                            <div class="mb-3">
                                                <label for="product_title" class="form-label">Product Title</label>
                                                <input type="text" class="form-control" id="product_title" name="product_title" value="' . $product['product_title'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="product_price" class="form-label">Product Price</label>
                                                <input type="number" class="form-control" id="product_price" name="product_price" value="' . $product['product_price'] . '" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "<p>No products available in this subcategory.</p>";
            }

            
            if (isset($_POST['update'])) {
                $productTitle = $_POST['product_title'];
                $productPrice = $_POST['product_price'];
                        
                // Update product details in the database
                $update_query = "UPDATE products SET product_title = '$productTitle', product_price = '$productPrice' WHERE product_subcategory = '$subcategory'";
                $result = mysqli_query($conn, $update_query);
                        
                if ($result) {
                    if (mysqli_affected_rows($conn) > 0) {
                        echo "<script>window.open('view_productspopular.php?subcategory=" . urlencode($_GET['subcategory']) . "', '_self');</script>";
                        exit();
                    } else {
                        echo "No changes were made to the product details.";
                    }
                } else {
                    echo "Error updating product details: " . mysqli_error($conn);
                }
            }
            
            
        ?>
    </div>
    <footer class="footer">
        &copy; 2023 mr.drip. All rights reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarClose = document.getElementById('sidebarClose');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        sidebarClose.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });

        // Close the sidebar when clicking outside of it
        window.addEventListener('click', (event) => {
            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>
