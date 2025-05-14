<?php
session_start();
require_once 'includes/config.php';
require_once 'functions/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cherry+Bomb&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>mr.d</title>
    <style>
        body {
            overflow-x: hidden;
            font-family: 'PT Sans Narrow', sans-serif;
            background-image: radial-gradient(rgb(68, 76, 247) 0.5px, rgb(229, 229, 247) 0.5px);
        }

        .btn-secondary,
        .btn-secondary:focus,
        .btn-secondary:active {
            color: #fff;
            background-color: rgb(42, 165, 134);
            border: none;
            box-shadow: none;
        }

        .form-control:focus {
            box-shadow: none;
            border: 1px solid rgb(42, 165, 134);
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            position: absolute;
            background-color: transparent;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown select {
            background: lightpink;
            color: black;
        }

        .dropdown select:hover {
            font-weight: bold;
        }

        .dropdown select:focus {
            outline: hotpink;
            text-transform: capitalize;
        }

        nav i {
            display: flex;
            font-size: 35px;
        }

        #logo {
            font-weight: bolder;
            font-size: 25px;
            margin-left: 2px;
        }

        #logo:hover {
            color: hotpink;
        }

        nav .fluid {
            display: flex;
        }

        #number {}

        .card-body {
            padding: 20px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            background: transparent;
        }

        select:hover {
            background: lightgray;
        }

        select:focus {
            outline: none;
            border-color: #00838f;
        }

        .card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0px 4px 8px hotpink;
            /* Added card shadow */

        }

        .card-body {
            display: none;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.1);
            color: white;
            padding: 10px;
            transition: opacity 0.3s;
        }

        .card:hover .card-body {
            display: block;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .row {
            flex-wrap: wrap;
        }

        .no-bullets {
            list-style-type: none;
            /* Remove bullet points */
            padding-left: 0;
            /* Remove left padding for list items */
        }

        .no-bullets li {
            margin-bottom: 5px;
            /* Add some spacing between list items */
        }

        /* The sidebar menu */
        .sidebar {
            height: 100%;
            /* 100% Full-height */
            width: 0;
            /* 0 width - change this with JavaScript */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Stay on top */
            top: 2%;
            left: 0;
            background-color: #f8f9fa;
            /* lightgray*/
            overflow-x: hidden;
            /* Disable horizontal scroll */
            padding-top: 60px;
            /* Place content 60px from the top */
            transition: 0.5s;
            /* 0.5 second transition effect to slide in the sidebar */
        }

        /* The sidebar links */
        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 22px;
            color: black;
            display: block;
            transition: 0.3s;
        }

        .sidebar .side-header {
            margin-left: 30px;
            margin-bottom: 8px;
            color: #fff;
        }

        /* When you mouse over the navigation links, change their color */
        .sidebar a:hover {
            background-color: hotpink;
        }

        /* Position and style the close button (top right corner) */
        .sidebar .closebtn {
            position: absolute;
            top: 1;
            right: 2px;
            font-size: 24px;
            margin-left: 50px;
            color: black;
            background-color: transparent;
        }

        .sidebar .closebtn:hover {
            background-color: transparent;
            color: #00838f;
        }

        .sidebar .closebtn:onclick {
            background-color: white;
            color: black;
        }

        /* The button used to open the sidebar */
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            padding: 10px 15px;
            border: none;
            color: hotpink;
            background: transparent;
        }

        .openbtn:hover {
            background-color: white;
            color: pink;
            transition: transform 0.3s;
        }

        .openbtn:onclick {
            font-weight: bolder;
            color: black;
        }

        .openbtn:focus {
            color: rgb(42, 165, 134);
        }

        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
        #main {
            transition: margin-left .5s;
            /* If you want a transition effect */
            padding: 20px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }

        .heart-icon {
            color: white;
        }

        .heart-icon.active {
            color: red;
        }

        .link-list {
            list-style-type: none;
            padding: 0;
            background: lightgray;
            margin: 2px;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        .link-list:hover {
            border: solid 1px black;
        }

        .show-on-hover .submenu {
            display: none;
            list-style-type: none;
            padding: 0;
        }

        .show-on-hover:hover .submenu {
            display: block;
        }

        .link-list a {
            text-decoration: none;
            color: black;
        }

        .link-list a:hover {
            color: blue;
            font-weight: 800;
        }


        .submenu li {
            margin-bottom: 5px;
        }

        #customer_services li a {
            color: blue;
        }

        #customer_services li a:hover {
            color: darkblue;
            font-weight: bold;
        }

        #customer_services li a i:hover {
            color: black;
            font-weight: bold;
        }

        .navbar {
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        ::selection {
            color: white;
            background: hotpink;
        }

        #nav_signup {
            background: hotpink;
            border-radius: 10px;
        }

        /* Customize modal styles */
        .modal-content {
            background-color: white;
            border-radius: 10px;
            border: none;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: hotpink;
            color: white;
            border-bottom: none;
        }

        .modal-title {
            font-weight: bold;
        }

        .modal-body {
            color: black;
        }

        .modal-footer {
            background-color: white;
            border-top: none;
        }

        /* Customize primary and secondary button styles */
        .btn-primary {
            background-color: hotpink;
            border-color: hotpink;
        }

        .btn-secondary {
            background-color: white;
            border-color: hotpink;
            color: hotpink;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: white;
            color: hotpink;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s;
            max-width: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0 35px;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-image {
            width: 100%;
            height: 270px;
            object-fit: cover;
        }

        .product-details {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-card:hover .product-details {
            opacity: 1;
        }

        .product-name {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 12px;
            color: hotpink;
            margin-bottom: 5px;
        }

        .product-original-price {
            text-decoration: line-through;
            color: #777;
            font-size: 10px;
            margin-bottom: 3px;
        }

        .product-category {
            font-size: 10px;
            color: white;
            background-color: hotpink;
            padding: 3px 6px;
            border-radius: 5px;
        }

        @media (max-width: 767px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(50%, 1fr));
            }
        }

        @media (min-width: 768px) {
            .product-card {
                margin: auto auto;
            }
        }

        .modal-content {
            background-color: #f5f5f5;
        }

        .modal-image {
            max-width: 100%;
            height: auto;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .modal-price {
            font-size: 16px;
            color: hotpink;
        }

        .modal-buttons {
            display: flex;
            align-items: center;
        }

        .modal-button {
            background-color: hotpink;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-button:hover {
            background-color: #ff4d94;
        }

        #productsSection {
            display: flex;
        }

        #productsDisplay {
            display: flex;
            ;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-start;
            margin: auto;
            margin-bottom: 2px;
        }

        .product-cad {
            background-color: white;
            border: 1px solid lightgray;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;

            margin-bottom: 20px;

        }

        .product-imae {
            width: 270px;
            max-height: 270px;
            object-fit: cover;
        }

        /* Style for the product titles */
        .product-tile {
            font-weight: bold;
            color: hotpink;
            /* Set secondary color to hotpink */
        }

        /* Style for the product descriptions */
        .product-description {
            color: gray;
        }

        /* Style for the product prices */
        .product-pice {
            font-weight: bold;
            color: hotpink;
            /* Set secondary color to hotpink */
        }

        /* Style for the add-to-cart button */
        .add-to-cart-button {
            background-color: hotpink;
            /* Set secondary color to hotpink */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .product-cad {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 767px) {
            .product-cad {
                width: calc(100% - 20px);
            }
        }

        /* CSS for the search results */
        .search-results {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .ploduct-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            width: calc(33.33% - 20px);
            /* Adjust as needed for responsive design */
        }

        .ploduct-image {
            max-width: 100%;
            height: auto;
        }

        .ploduct-title {
            font-size: 18px;
            margin: 10px 0;
        }

        .ploduct-price {
            font-weight: bold;
            color: #007bff;
        }

        .ardd-to-cart {
            background-color: hotpink;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .ardd-to-cart:hover {
            border: solid 3px hotpink;
            padding: 4px;
        }

        /* Responsive styles for mobile view */
        @media (max-width: 767px) {
            .search-results {
                flex-direction: column;
                align-items: center;
            }

            .ploduct-card {
                width: 100%;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <div class="container m-auto ml-2">
            <div><button class="openbtn" onclick="openNav()"><i class="bx bx-menu"></i></button></div>
            <div class="mr-auto"><a class="navbar-brand mr-auto" href="index.php" id="logo" style="font-family: 'Arimo', sans-serif;">mr.drip</a></div>
            <div class="d-flex justify-content-between">
                <?php
                // Check if the user is logged in
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                    echo '<div class="mr-2"><a href="profile.php" title="View Profile"><i class=\'bx bx-user\' id="user" style="color: hotpink;"></i></a>';

                    // Start PHP block for the number

                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = $conn->query($sql);
                    $count = 0;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if (empty($row['phone_number'])) { // Check if phone_number is empty
                                $count = $count + 1;
                            }
                        }
                    }
                    // Display the number using HTML
                    if ($count > 0) {
                        echo '<sup id="number" title="add phone number" style="background-color: hotpink; color: white; padding: 2px 5px; border-radius: 50%; font-size: 12px;">';
                        echo $count;
                        echo '</sup>';
                    }

                    echo '</div>';
                }
                ?>

                <div><a href="cart.php"><i class='bx bxs-shopping-bags ml-4' id="shop" style="color: hotpink;"></i></a><sup id="number" style="background-color: hotpink; color: white; padding: 2px 5px; border-radius: 50%; font-size: 12px;">
                        <?php
                        $sql = "SELECT * from cart";
                        $result = $conn->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $count = $count + 1;
                            }
                        }
                        echo $count;
                        ?>
                    </sup></div>
            </div>

    </nav>



    <div class="sidebar" id="mySidebar">
        <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class='bx bx-arrow-back'></i></a>
        <a href="index.php" class="text-left"><i class='bx bx-store' style="font-size:28px;color: hotpink;"></i> Home</a>
        <a href="contact.php" class="text-left"><i class='bx bx-envelope-open' style="font-size:28px;color: hotpink;"></i>Contact us</a>
        <?php
        // Check if the user is logged in
        if (isset($_SESSION['email'])) {
            echo '<a data-bs-target="#logoutModal" data-bs-toggle="modal" href="logout.php" class="text-left"><i class="bx bx-exit" style="font-size:28px;color: hotpink;"></i>Logout</a>';
            $userEmail = $_SESSION['email'];
            $checkOrdersQuery = "SELECT * FROM orders WHERE user_email = '$userEmail'";
            $ordersResult = mysqli_query($conn, $checkOrdersQuery);

            if (mysqli_num_rows($ordersResult) > 0) {
                echo '<a href="orders.php" class="text-left"><i class="bx bx-list-check" style="font-size:28px;color: hotpink;"></i> My Orders</a>';
            }
        } else {
            echo '<a  href="register.php" class="text-left"><i class="bx bxs-user-plus" style="font-size:28px;color: hotpink;"></i>Signup</a>';
            echo '<a  href="login.php" class="text-left"><i class="bx bxs-user" style="font-size:28px;color: hotpink;"></i>Login</a>';
        }


        ?>
    </div>

    <?php
    // Initialize variables
    $categories = array();
    $searchResults = array();
    $searchMessage = "";

    // Step 1: Retrieve distinct categories
    $sql = "SELECT DISTINCT product_category FROM products WHERE product_category='Men' or product_category='Women' or product_category='Kids' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row['product_category'];
        }
    }

    // Step 2: Handle form submission
    if (isset($_POST['search'])) {
        $selectedCategory = $_POST['category'];
        $productTitle = $_POST['productTitle'];

        // Step 3: Create a query to search products
        $searchQuery = "SELECT * FROM products WHERE product_category = '$selectedCategory' AND product_title LIKE '%$productTitle%'";
        $searchResult = mysqli_query($conn, $searchQuery);

        if ($searchResult) {
            while ($row = mysqli_fetch_assoc($searchResult)) {
                $searchResults[] = $row;
            }

            if (count($searchResults) > 0) {
                $searchMessage = count($searchResults) . " products found.";
            } else {
                $searchMessage = "No products found.";
            }
        }
    }
    ?>

    <!-- Add this section to display the search message -->



    <div class="container m-auto mt-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card p-3 py-4">
                    <h5>What are you looking for?</h5>
                    <form method="POST">
                        <div class="row g-3 mt-2">
                            <div class="col-md-3">
                                <div class="dropdown">
                                    <select class="btn btn-secondary dropdown-toggle" name="category">
                                        <?php
                                        foreach ($categories as $category) {
                                            echo "<option value='$category'>$category</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="productTitle" placeholder="Enter product title e.g jordan, polo, cargo">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success btn-block" style="background: hotpink; border: none;" name="search">Search Results</button>
                            </div>
                        </div>
                    </form>
                    <div class="search-message m-auto text-warning">
                        <?php echo $searchMessage; ?>
                    </div>
                    <div class="search-results">
                        <?php
                        if (count($searchResults) > 0) {
                            foreach ($searchResults as $product) {
                        ?>
                                <div class="ploduct-card">
                                    <img src="admin/product_images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title']; ?>" class="ploduct-image">
                                    <h3 class="ploduct-title"><?php echo $product['product_title']; ?></h3>
                                    <p class="ploduct-price">$<?php echo $product['product_price']; ?></p>
                                    <button class="btn btn-primary ardd-to-cart" data-product-id="<?php echo $product['product_id']; ?>">Add to Cart</button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div><br><br>
    <h2 class="text-center" style="font-family: 'Cherry Bomb', cursive;">Shop now</h2>
    <h6 class="text-center" style=" font-family: 'Pacifico', cursive;">Drip is the new fashion</h6>
    <div class="container mt-4 flex-wrap " style="border: solid 1px lightgray; border-radius: 7px; padding: 7px;">
        <div class="row">
            <?php
            $allowedCategories = ['Men', 'Women', 'Kids'];

            foreach ($allowedCategories as $category) {
                // Set column width classes based on the number of categories
                $colWidthClass = 'col-md-4'; // Adjust the width as needed

                echo '<div class="' . $colWidthClass . '">';
                echo '<div class="card" style="border: none;">';
                echo '<div class="text-center">';
                echo '<ul class="link-list">';
                echo '<li class="show-on-hover"><a href="#" style="font-weight: bold;">' . $category . '</a>';
                echo '<ul class="submenu">';

                // Fetch subcategories for the current category
                $subcategoriesQuery = "SELECT DISTINCT product_subcategory FROM products WHERE product_category = '$category'";
                $subcategoriesResult = $conn->query($subcategoriesQuery);

                while ($subcategoryRow = $subcategoriesResult->fetch_assoc()) {
                    $subcategory = $subcategoryRow['product_subcategory'];
                    echo '<li><a href="get_products_by_subcategory.php" class="subcategory-link" data-subcategory="' . $subcategory . '">' . $subcategory . '</a></li>';
                }

                echo '</ul></li></ul></div></div></div>';
            }
            ?>
        </div>
    </div>
    <div id="productsSection" class="row">
        <div class="col-md-12">
            <div id="productsDisplay" style="margin-bottom:2px;">
                <!-- Products will be displayed here -->
            </div>
        </div>
    </div>



    <div class="container content-to-hide">
        <h2 class="text-center mt-4">Products on Offer</h2>
        <?php
        // Fetch products on offer from the database
        $sql = "SELECT * FROM products WHERE product_category = 'Offer' ORDER BY rand() LIMIT 0,6";
        $result = $conn->query($sql);

        displayProductSection($result);

        ?>

        <h2 class="text-center">Popular Products</h2>
        <?php
        // Fetch popular products from the database
        $sql = "SELECT * FROM products WHERE product_category = 'Popular' ORDER BY rand() LIMIT 0,6";
        $result = $conn->query($sql);

        displayProductSection($result);

        ?>

        <h2 class="text-center">New Arrivals</h2>
        <?php
        // Fetch new arrivals from the database
        $sql = "SELECT * FROM products WHERE product_category = 'New' ORDER BY rand() LIMIT 0,6";
        $result = $conn->query($sql);

        displayProductSection($result);

        ?>
    </div>




    </div>


    <div id="offers" class="container mt-5 content-to-hide">
        <h2 class="text-center">What We Offer</h2>
        <div class="row mt-4">
            <div class="col-md-4 mb-2">
                <div class="card text-center px-4 py-4">
                    <div class="">
                        <h5 class="card-title"><strong>Orders</strong></h5>
                        <i class='bx bxs-credit-card' style="font-size: 35px;color:hotpink"></i>
                        <p class="card-text">Place your orders easily and conveniently through our website. Browse our wide range of products and add them to your cart.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-auto mb-2">
                <div class="card text-center px-4 py-4">
                    <div class="">
                        <h5 class="card-title"><strong>Delivery</strong></h5>
                        <i class='bx bxs-truck' style="font-size: 35px;color:hotpink"></i>
                        <p class="card-text">We offer fast and reliable delivery services. Your orders will be delivered to your doorstep in no time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 m-auto mb-2">
                <div class="card text-center px-4 py-4">
                    <div class="">
                        <h5 class="card-title"><strong>Program</strong></h5>
                        <i class='bx bx-gift' style="font-size: 35px;color:hotpink"></i>
                        <p class="card-text">We are yet to launch a loyalty program to earn rewards with every purchase.Continue shopping ,great things ahead.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 m-auto mb-2">
            <div class="col-md-12">
                <div class="card text-center px-4 py-4 mb-2">
                    <div class="">
                        <h5 class="card-title"><strong>FAQs</strong></h5>
                        <p class="card-text">Have questions? Check out our FAQs section to find answers to commonly asked questions about our products, services, and policies.</p>
                        <a href="faqs.html" class="btn" style="background: rgb(42, 165, 134);">Read FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <nav class="navbar-bottom navbar-light bg-light content-to-hide">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>About Us</h4>
                    <p>We are dedicated to offer fashion products to make you more confident and find your perfect look.</p>

                    <i class='bx bxl-instagram' style="color: rgb(42, 165, 134);"></i>
                    <i class='bx bxl-facebook-square' style="color: rgb(42, 165, 134);"></i>
                    <i class='bx bxl-twitter' style="color: rgb(42, 165, 134);"></i>
                    <i class='bx bxl-linkedin-square' style="color: rgb(42, 165, 134);"></i>

                </div>
                <div class="col-md-4">
                    <h4>Customer Service</h4>
                    <div class="d-flex ">
                        <ul class="no-bullets text-left" id="customer_services">
                            <li><a href="faqs.html" style="text-decoration: none;"><i class='bx bx-chevrons-right' style="font-size: 20px;"></i>Returns & Exchanges</a></li>
                            <li><a href="faqs.html" style="text-decoration: none;"><i class='bx bx-chevrons-right' style="font-size: 20px;"></i>Privacy Policy</a></li>
                            <li><a href="faqs.html" style="text-decoration: none;"><i class='bx bx-chevrons-right' style="font-size: 20px;"></i>Terms & Conditions</a></li>
                            <li><a href="faqs.html" style="text-decoration: none;"><i class='bx bx-chevrons-right' style="font-size: 20px;"></i>Shipping & Delivery</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>Connect</h4>
                    <ul class="no-bullets">
                        <li><a href="contact.php">Contact Us</a></li>
                        <li class="newsletter">
                            <p style="color: hotpink;font-weight: bolder; font-size: medium;font-family: 'Nanum Gothic', sans-serif;">Be the first to know about our amazing deals!</p>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                if (isset($_POST['subscribe'])) {
                                    $email = $_POST['email'];
                                    $sqlInsert = "INSERT INTO newsletters (email) VALUES ('$email')";

                                    if (mysqli_query($conn, $sqlInsert)) {
                                        // Data inserted successfully, 
                                    } else {
                                        //  insertion failed
                                    }
                                }
                            }
                            ?>
                            <form method="POST">
                                <div class="d-flex">
                                    <div><input class="form-control" type="email" name="email" placeholder="Email"></div>
                                    <div><button class="btn btn-success" type="submit" name="subscribe">Subscribe</button></div>
                                </div>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background:transparent;border:none;"><i class='bx bx-x' style="font-size:28px;"></i></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="logoutLink" href="logout.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to toggle the "no-scroll" class on the body element
        function toggleNoScroll() {
            document.body.classList.toggle("no-scroll");
        }

        function openNav() {
            document.getElementById("mySidebar").style.width = "185px";
            document.getElementById("main").style.marginLeft = "250px";
            document.getElementById("main-content").style.marginLeft = "250px";
            document.getElementById("main").style.display = "none";

            // Call the function to add the "no-scroll" class
            toggleNoScroll();
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.getElementById("main").style.display = "block";

            // Call the function to remove the "no-scroll" class
            toggleNoScroll();
        }

        document.addEventListener("DOMContentLoaded", function() {
            const heartButtons = document.querySelectorAll(".heart-button");

            heartButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    const heartIcon = button.querySelector(".heart-icon");
                    heartIcon.classList.toggle("active");
                });
            });
        });

        $(document).ready(function() {
            $('.subcategory-link').on('click', function(e) {
                e.preventDefault();
                const subcategory = $(this).data('subcategory');
                $.ajax({
                    type: 'GET', // Use GET method
                    url: 'get_products_by_subcategory.php', // Replace with your PHP script URL
                    data: {
                        subcategory: subcategory
                    }, // Pass the selected subcategory
                    dataType: 'html',
                    success: function(response) {
                        // Hide other content and show products
                        $('#productsSection').addClass('visible');
                        $('#otherContent').addClass('hidden');

                        // Populate the products display section
                        $('#productsDisplay').html(response);
                    },
                    error: function(error) {
                        console.error('Error fetching products:', error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $(".submenu a").on("click", function(event) {
                event.preventDefault(); // Prevent default link behavior
                $(".content-to-hide").hide(); // Hide the content
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>