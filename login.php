<?php
session_start();
// Include the database configuration
require_once 'includes/config.php';

// Initialize variables for error message
$errorMessage = "";

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($email) || empty($password)) {
        $errorMessage = "Both email and password are required.";
    } else {
        // Retrieve user data from the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Successful login
                $_SESSION['email']=$email;
                header("Location: index.php"); 
                exit();
            } else {
                $errorMessage = "Incorrect password.";
            }
        } else {
            $errorMessage = "User not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .login-icon {
            font-size: 36px;
            color: hotpink;
            margin-bottom: 20px;
        }
        .form-label {
            color: hotpink;
        }
        .btn-login {
            background-color: hotpink;
            border: none;
            width: 100%;
        }
        .btn-login:hover {
            border: solid 3px hotpink;
            color:hotpink;
            font-weight: bold;
        }
        .forgot-password {
            color: hotpink;
            text-align: center;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <div class="text-center">
                        <i class='bx bxs-user-circle login-icon'></i>
                        <h2>Welcome Back! Please Login</h2>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <?php if ($errorMessage !== ""): ?>
        <div class="card mb-2 text-center" role="alert" style="font-weight:bold;border-left: solid 4px red;background:biege;border:solid 2px red;">
            <?php echo $errorMessage; ?>
        </div>
        <?php endif; ?>
                            <button type="submit" class="btn btn-login" name="login">Login</button>
                        </div>
                        <p class="forgot-password">
                            <a href="#">Forgot Password?</a>
                        </p>
                    </form>
                    <p class="text-center mt-3">
                        Don't have an account? <a href="register.php">Sign Up here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
