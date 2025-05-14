<?php
session_start();
require_once '../includes/config.php';

// Initialize variables for error messages
$errorMessage = "";

// Check if the form is submitted
if (isset($_POST['register'])) {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Basic validation
    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Check if admin with the same email exists
        $sqlCheckAdmin = "SELECT * FROM admins WHERE email = '$email'";
        $resultCheckAdmin = mysqli_query($conn, $sqlCheckAdmin);

        if (mysqli_num_rows($resultCheckAdmin) > 0) {
            $errorMessage = "An admin with the same email already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert admin data into the database
            $sql = "INSERT INTO admins (full_name, email, password) VALUES ('$fullName', '$email', '$hashedPassword')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['admin_email'] = $email;
                header("Location: admin_login.php");
                exit();
            } else {
                $errorMessage = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 20pxs;
        }

        .icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        .form-group label {
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <i class="icon bx bx-user-plus"></i>
            <h2>Admin Registration</h2>
        </div>
        <form method="POST">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <!-- Displaying error message -->
            <?php if ($errorMessage !== ""): ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
                <a href="admin_login.php" class="btn text-decoration-none btn-primary btn-block">Login</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
