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

if (isset($_POST['insertProduct'])) {
    $productCategory = $_POST['productCategory'];
    $productTitle = $_POST['productTitle'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $initial_price= $_POST['productIntPrice'];
    $productImage = $_FILES['productImage']['name'];

    // Upload product image
    $targetDir = "product_images/";
    $targetFile = $targetDir . basename($productImage);

    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
        // Insert product data into the database
        $insertProductQuery = "INSERT INTO products (product_title, product_description, product_image, product_price, initial_price, product_category, product_subcategory)
        VALUES ('$productTitle', '$productDescription', '$productImage', $productPrice, $initial_price, '$productCategory', '$productCategory')";
        
        if (mysqli_query($conn, $insertProductQuery)) {
            // Product inserted successfully
            header("Location: display.php");
            exit();
        } else {
            // Error inserting product
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
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
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: #fff;
    position: absolute;
    bottom: 0;
    width: 100%;
    z-index: 10; /* Ensure the footer is above the modal */
}

@media (max-width: 767px) {
    .footer {
        position: relative; /* Change to relative positioning for mobile */
    }
}


        @media (max-width: 767px) {
            .dashboard-card {
                width: calc(50% - 20px);
            }
        }
        #down-menu:hover{
            color: black;
        }
        .category-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .subcategories {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .subcategory-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: calc(33.33% - 20px);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
            cursor: pointer;
        }

        .subcategory-card:hover {
            transform: translateY(-5px);
        }

        .subcategory-title {
            margin-top: 10px;
            font-size: 28px;
            color: #333;
        }

        .add-subcategory-card {
            background-color: #fff;
            border: 1px dashed #ccc;
            border-radius: 10px;
            padding: 20px;
            width: calc(33.33% - 20px);
            text-align: center;
            cursor: pointer;
        }

        .add-subcategory-card:hover {
            background-color: #f9f9f9;
        }

        .add-subcategory-icon {
            font-size: 48px;
            color: #ccc;
        }
        @media (max-width: 991px) {
    .subcategory-card {
        width: calc(50% - 20px);
    }
}

@media (max-width: 767px) {
    .subcategory-card {
        width: calc(100% - 20px);
    }
}

.modal-header {
    background: rgba(0, 0, 255, 0.7); /* Blue with 80% opacity */
    color: white;
}
#sticky-navbar {
    position: sticky;
    top: 0;
    z-index: 100;
}

    </style>
</head>
<body>
    <nav class="navbar" id="sticky-navbar">
        <div class="container-fluid">
            <button class="btn btn-link text-white" id="sidebarToggle"><i class="bx bx-menu bx-lg"></i></button>
            <span class="navbar-brand">Home display </span>
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

    <div class="subcategories">
    <div class="subcategory-card" data-category="Offer">
        <div class="subcategory-title">Products on offer</div>
            <a class="btn btn-primary" href="view_productsoffer.php?subcategory=' . $row['subcategory'] . '">View</a>
        <div class="mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Insert Product</button>
        </div>
    </div>
    <div class="subcategory-card" data-category="Popular">
        <div class="subcategory-title">Popular Products</div>
            <a class="btn btn-primary" href="view_productspopular.php?subcategory=' . $row['subcategory'] . '">View</a>
        <div class="mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Insert Product</button>
        </div>
    </div>
    <div class="subcategory-card" data-category="New">
        <div class="subcategory-title">New Arrivals</div>
            <a class="btn btn-primary" href="view_productsnew.php?subcategory=' . $row['subcategory'] . '">View</a>
        <div class="mt-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Insert Product</button>
        </div>
    </div>
    



    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Insert Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <select class="form-control" id="productCategory" name="productCategory" required>
                            <option value="Offer">Offer</option>
                            <option value="Popular">Popular</option>
                            <option value="New">New</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productTitle" class="form-label">Product Title</label>
                        <input type="text" class="form-control" id="productTitle" name="productTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="productIntPrice" class="form-label">Initial price</label>
                        <input type="number" class="form-control" id="productIntPrice" name="productIntPrice" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="insertProduct">Insert Product</button>
                </form>
            </div>
        </div>
    </div>
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

        document.addEventListener('DOMContentLoaded', function () {
        const subcategoryCards = document.querySelectorAll('.subcategory-card');
        const productCategorySelect = document.getElementById('productCategory');

        subcategoryCards.forEach(card => {
            card.addEventListener('click', function () {
                const category = this.getAttribute('data-category');
                productCategorySelect.value = category;
            });
        });
    });
    </script>
    </body>
    </html>