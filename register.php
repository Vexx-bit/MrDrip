<?php
// Include the database configuration
require_once 'includes/config.php';

$successMessage = "";
$errorMessage = "";

// Check if the form is submitted
if(isset($_POST['register'])) {
    // Retrieve form data
    $_SESSION['email']=$_POST['email'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $_SESSION['email']=$email;
    
    // Basic validation
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Check if the user already exists
        $checkUserQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkUserQuery);
        if (mysqli_num_rows($result) > 0) {
            $errorMessage = "User with this email already exists.";
        } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashedPassword')";
        if (mysqli_query($conn, $sql)) {
            $successMessage = "Registration successful!";
            header("Location: login.php");
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
    <title>Register Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }
        .register-container {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .register-icon {
            font-size: 36px;
            color: hotpink;
            margin-bottom: 20px;
        }
        .form-label {
            color: hotpink;
        }
        .btn-register {
            background-color: hotpink;
            border: none;
            width: 100%;
        }
        .btn-register:hover {
            border: solid 3px hotpink;
            color:hotpink;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-container">
                    <div class="text-center">
                        <i class='bx bxs-user-plus-circle register-icon'></i>
                        <h2>Sign up here!</h2>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
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
                        <!-- Display success message -->
<?php if ($successMessage !== ""): ?>
<div class="card mb-2 text-center" role="alert"  style="font-weight:bold;border-left: solid 4px green;border-radius:2px;background:biege;border:solid 2px green;">
    <?php echo $successMessage; ?>
</div>
<?php endif; ?>

<!-- Display error message -->
<?php if ($errorMessage !== ""): ?>
<div class="card mb-2 text-center" role="alert" style="font-weight:bold;border-left: solid 4px red;background:biege;border:solid 2px red;">
    <?php echo $errorMessage; ?>
</div>
<?php endif; ?>
                        <button type="submit" class="btn btn-register" name="register">Register</button>
                    </form>
                    <p class="text-center mt-3">
                        Already have an account? <a href="login.php">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
