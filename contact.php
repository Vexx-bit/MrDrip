<?php
session_start();
require_once './includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $enqName = mysqli_real_escape_string($conn, $_POST['name']);
    $enqEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $enqMessage = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert enquiry data into the database
    $sqlInsertEnquiry = "INSERT INTO enquiries (enq_name, enq_email, enq_message) VALUES ('$enqName', '$enqEmail', '$enqMessage')";

    if (mysqli_query($conn, $sqlInsertEnquiry)) {
        // Redirect to homepage or show success message
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    } else {
        // Handle error if the insertion fails
        $errorMessage = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }

        .contact-card {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-icon {
            font-size: 36px;
            color: hotpink;
            margin-bottom: 20px;
        }

        .social-icons a {
            color: hotpink;
            margin-right: 10px;
        }

        .footer {
            background-color: hotpink;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="contact-card">
                    <div class="text-center">
                        <i class='bx bx-envelope-open contact-icon'></i>
                        <h2>Talk to Us</h2>
                    </div>
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="send">Send</button>
                        <a href="index.php" class="btn"><i class='bx bx-left-arrow-circle' style="font-size: medium;"></i>Home</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="social-icons">
            <a href="#"><i class='bx bxl-facebook' style="color: black;font-size: x-large;"></i></a>
            <a href="#"><i class='bx bxl-twitter' style="color: black;font-size: x-large;"></i></a>
            <a href="#"><i class='bx bxl-instagram' style="color: black;font-size: x-large;"></i></a>
            <a href="#"><i class='bx bxl-linkedin' style="color: black;font-size: x-large;"></i></a>
        </div>
        <p>&copy; 2023 mr.drip. All Rights Reserved.</p>
    </footer>
</body>

</html>