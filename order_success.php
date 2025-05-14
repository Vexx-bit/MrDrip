<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-message {
            text-align: center;
            background-color: #28a745;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="success-message">
        <h1>Order Successfully Placed!</h1>
        <img src="success.png" style="height:200px;width:100%;object-fit:contain;"> 
        <p>Your order has been processed.</p>
    </div>

    <script>
        // Redirect to the index page after 4 seconds
        setTimeout(function() {
            window.location.href = "index.php";
        }, 2000); // 4 seconds in milliseconds
    </script>
</body>
</html>
