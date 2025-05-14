<?php
// Set up the API credentials
$consumer_key = 'AnJIZYfHZbRTM9dd72ErV5BIVMJ5p8PJ';
$consumer_secret = '5neDD0jj0dZfOs5b';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $phone_number = $_POST['phone_number'];
    $amount = $_POST['amount'];

    // Construct the authorization request
    $authorization = base64_encode($consumer_key . ':' . $consumer_secret);
    $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . $authorization,
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle the response
    $data = json_decode($response, true);
    $access_token = $data['access_token'];

    // Make the STK push request
    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $BusinessShortCode = '174379';
    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . 'MTc0Mzc5YmZiMjc5TliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3' . $Timestamp);
    $CallbackURL = 'https://morning-basin-87523.herokuapp.com/callback_url.php';

    // Other parameters for the payment request (customize as per your requirements)
    $AccountReference = 'YourAccountReference';
    $TransactionDesc = 'Payment for Products';
    $Remarks = 'Thank you for your purchase!';

    // Create the request body
    $request = [
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phone_number,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $phone_number,
        'CallBackURL' => $CallbackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc,
        'Remarks' => $Remarks,
    ];

    // Convert the request to JSON
    $request_json = json_encode($request);

    // Set up cURL for the STK push request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle the STK push response
    $stk_response = json_decode($response, true);

    // Display the response to the user (For demonstration purposes only, you can customize how you handle the response)
    echo "STK Push Response: " . print_r($stk_response, true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>STK Push Payment</title>
</head>
<body>
    <h1>STK Push Payment</h1>
    <form method="post">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>
        <label for="amount">Amount:</label>
        <input type="text" name="amount" required><br>
        <input type="submit" value="Pay">
    </form>
</body>
</html>
