<?php
// verify.php

// Include the database connection file
include 'connection.php';

// Get the transaction reference
$transaction_id = $_GET['transaction_id'];

// Your Flutterwave secret key
$secret_key = 'FLWSECK_TEST-75b4b26fe0fbb103c0a6f86f34fda2e4-X'; // Replace with your secret key

// Initialize cURL
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/transactions/$transaction_id/verify");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $secret_key",
    "Content-Type: application/json",
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

echo $response;

// Check for cURL errors
// if (curl_errno($ch)) {
//     echo 'cURL Error: ' . curl_error($ch);
//     // Handle the error gracefully here
// } else {
//     // Parse the JSON response
//     $response_data = json_decode($response, true);

//     // Check if the request was successful
//     if ($response_data && isset($response_data['status']) && $response_data['status'] === 'success') {
//         // The transaction was successful, you can process the order
//         echo 'Transaction was successful';
//     } else {
//         // The transaction was not successful
//         echo 'Transaction not successful: ' . $response_data['message'];
//         // Handle the error gracefully here
//     }
// }

// Close the cURL session
curl_close($ch);
?>