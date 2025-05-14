<?php
session_start();
require_once '../includes/config.php';

// Initialize variables for error messages
$errorMessage = "";

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve admin data from the database
    $sql = "SELECT * FROM admins WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['admin_email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $errorMessage = "Incorrect password.";
        }
    } else {
        $errorMessage = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
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
            <i class="icon bx bx-user"></i>
            <h2>Admin Login</h2>
        </div>
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <label for="password" class="form-label">Password</label>
            <div class="mb-3 border-2 d-flex">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class=" toggle-password" id="toggle-password"><i class='bx bx-hide' style="font-size:22px;margin-top:6px;margin-left:4px;"></i></span>
                

            </div>
            <!-- Displaying error message -->
            <?php if ($errorMessage !== ""): ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
  const togglePassword = document.querySelector('#toggle-password');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the icon
    const icon = this.querySelector('i');
    icon.classList.toggle('bx-hide');
    icon.classList.toggle('bx-show');
  });
</script>
</body>
</html>
