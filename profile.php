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

// Check if phone_number is empty
if (empty($userData['phone_number'])) {
    $showAddNumberCard = true;
} else {
    $showAddNumberCard = false;
}

// Handle update form submission
if(isset($_POST['update'])) {
    $newFullName = $_POST['new_fullname'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];

    $updateSql = "UPDATE users SET fullname = '$newFullName', email = '$newEmail', phone_number='$newPhone' WHERE email = '$email'";
    if(mysqli_query($conn, $updateSql)) {
        // Update successful, refresh the page to show updated data
        header("Location: profile.php");
        exit();
    }
}

// Handle delete account
if(isset($_POST['delete'])) {
    $deleteSql = "DELETE FROM users WHERE email = '$email'";
    if(mysqli_query($conn, $deleteSql)) {
        // Account deleted, redirect to login page
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
if(isset($_POST['add_phone'])) {
    $newPhoneNumber = $_POST['phone_number'];

    $updatePhoneSql = "UPDATE users SET phone_number = '$newPhoneNumber' WHERE email = '$email'";
    if(mysqli_query($conn, $updatePhoneSql)) {
        // Phone number updated successfully
        header("Location: profile.php");
        exit();
    } else {
        // Handle error if update fails
        echo "Error updating phone number: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }
        .profile-container {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-icon {
            font-size: 36px;
            color: hotpink;
            margin-bottom: 20px;
        }
        .profile-data {
            color: hotpink;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .edit-form {
            display: none;
        }
        .btn-primary {
            background-color: hotpink;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff69b4;
            border: none;
        }
        .btn-danger {
            background-color: hotpink;
            border: none;
        }
        .btn-danger:hover {
            background-color: #ff69b4;
            border: none;
        }
        .card {
        margin-top: 20px;
        border: none;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: hotpink;
    }

    .form-label {
        color: hotpink;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid hotpink;
    }

    .btn-primary {
        background-color: hotpink;
        border: none;
    }

    .btn-primary:hover {
        background-color: #ff69b4;
        border: none;
    }
    .form-control:focus {
    border-color:#ff69b4; 
    box-shadow: none; 
    outline: none;
}
    </style>
</head>
<body>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-container">
                    <div class="text-center">
                        <i class='bx bxs-user-circle profile-icon'></i>
                        <h2>Welcome, <?php echo $userData['fullname']; ?>!</h2>
                    </div>
                    <div class="profile-info">
                        <p class="profile-data">Full Name: <?php echo $userData['fullname']; ?></p>
                        <p class="profile-data">Email: <?php echo $userData['email']; ?></p>
                        <p class="profile-data">Date Created: <?php echo $userData['date_created']; ?></p>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary" id="editBtn">Edit Account</button>
                        <form id="editForm" method="POST" style="display:none;">
                            <div class="mb-3">
                                <label for="new_fullname" class="form-label">New Full Name</label>
                                <input type="text" class="form-control" id="new_fullname" name="new_fullname" value="<?php echo $userData['fullname']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="new_email" class="form-label">New Email</label>
                                <input type="email" class="form-control" id="new_email" name="new_email" value="<?php echo $userData['email']; ?>">
                            </div>
                            <?php if (!empty($userData['phone_number'])){ ?>
                            <div class="mb-3">
                                <label for="new_phone" class="form-label">New Phone No.</label>
                                <input type="text" class="form-control" id="new_phone" name="new_phone" value="<?php echo $userData['phone_number']; ?>">
                            </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                            <button type="button" class="btn btn-danger" id="cancelEdit">Cancel</button>
                        </form>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                            <button type="submit" class="btn btn-danger mt-3" name="delete">Delete Account</button>
                        </form>
                        <div class="text-center mt-2"><a href="index.php" class="btn btn-light text-decoration-none" style="border: #ff69b4;border: radius 5px;color:#ff69b4;">Home</a></div>
                    

                    <?php if ($showAddNumberCard): ?>
                        <div class="card mt-4 bg-white text-dark">
                            <div class="card-body">
                            <h5>Add Your Phone Number</h5>
                            <form>
                            <div class="form-floating w-50 m-auto">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="countryDropdown">
                                    Select Country
                                    </button>
                                    <div class="dropdown-menu" id="countryDropdownMenu">
                                    <!-- Country codes will be dynamically inserted here -->
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="phoneNumber" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
        const editBtn = document.getElementById('editBtn');
        const editForm = document.getElementById('editForm');
        const cancelEdit = document.getElementById('cancelEdit');

        editBtn.addEventListener('click', () => {
            editForm.style.display = 'block';
            editBtn.style.display = 'none';
        });

        cancelEdit.addEventListener('click', () => {
            editForm.style.display = 'none';
            editBtn.style.display = 'block';
        });

        document.getElementById("new_fullname").addEventListener("input", function() {
            var inputValue = this.value;
            var sanitizedValue = inputValue.replace(/['",]/g, "");
            this.value = sanitizedValue;
        });

        // Function to populate country dropdown
    function populateCountryDropdown() {
      // Define East African countries and their codes
      const countries = [
        { name: 'Kenya', code: '+254' },
        { name: 'Uganda', code: '+256' },
        { name: 'Tanzania', code: '+255' },
        { name: 'Rwanda', code: '+250' },
        { name: 'Burundi', code: '+257' },
        { name: 'South Sudan', code: '+211' },
        { name: 'Somalia', code: '+252' }
      ];
  
      // Populate dropdown menu with country codes
      const dropdownMenu = $('#countryDropdownMenu');
      countries.forEach(country => {
        dropdownMenu.append(`<a class="dropdown-item" href="#" data-code="${country.code}">${country.name} (${country.code})</a>`);
      });
  
      // Add click event listener to dropdown items to select country code
      $('.dropdown-item').click(function() {
        const countryCode = $(this).data('code');
        $('#countryDropdown').text(countryCode);
      });
    }
  
    // Function to pre-select country based on user's location
    function preselectCountry() {
      // Mock function to get user's location (replace with actual implementation)
      const userLocation = 'Kenya'; // Mock user location (e.g., based on IP)
  
      // Find matching country in dropdown and pre-select it
      const countries = $('#countryDropdownMenu').find('.dropdown-item');
      countries.each(function() {
        const countryName = $(this).text().split('(')[0].trim();
        if (countryName === userLocation) {
          const countryCode = $(this).data('code');
          $('#countryDropdown').text(countryCode);
          return false; // Break out of loop once country is found
        }
      });
  
      // Disable other country codes
      countries.each(function() {
        const countryName = $(this).text().split('(')[0].trim();
        if (countryName !== 'Kenya') {
          $(this).addClass('disabled');
        }
      });
    }
  
    // Call functions when document is ready
    $(document).ready(function() {
      populateCountryDropdown();
      preselectCountry();
    });
    </script>
</body>
</html>
