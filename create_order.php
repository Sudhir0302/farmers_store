<?php
// Replace with your actual Razorpay API key and secret
$razorpay_key = 'YOUR_RAZORPAY_API_KEY';
$razorpay_secret = 'YOUR_RAZORPAY_API_SECRET';

// Amount in paisa (e.g., ₹100 = 10000 paisa)
$amount = 10000; // Example amount

// Generate a unique order ID
$order_id = uniqid();

// Prepare data to be sent to Razorpay
$data = array(
    'amount' => $amount,
    'currency' => 'INR',
    'receipt' => $order_id
);

// Initialize cURL session
$ch = curl_init('https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $razorpay_key . ':' . $razorpay_secret);

// Execute cURL session and capture the response
$response = curl_exec($ch);
curl_close($ch);

// Decode the response
$data = json_decode($response, true);

// Extract order ID from response
$order_id = $data['id'];

// Return order ID as JSON
echo json_encode(array('order_id' => $order_id));
?>
