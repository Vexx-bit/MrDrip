<?php
session_start();
require_once './includes/config.php';

if(isset($_POST['submit'])){
function initiateCharge() {
    // Initialize cURL session
    $ch = curl_init();

    // Define the charge request body
    $charge_body = json_encode([
        "data" => [
            "type" => "charge",
            "id" => uniqid(), // Generate a unique ID
            "attributes" => [
                "amount" => 1,
                "customer_no" => "254706036754",
                "short_code" => "174379",
                "posted_at" => date('c'), // Use current date and time
                "reference" => "1234"
            ]
        ]
    ]);

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "https://tryapi.quikk.dev/v1/mpesa/charge"); // Replace with actual API endpoint URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $charge_body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer fe60d35396fd62e6a2681e9d4a6b215f ' // Replace with your API key
    ]);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    return $response;
}

// Call the function to initiate charge
$response = initiateCharge();

// Print the response (you can handle it as needed)
echo $response;
}
?>
