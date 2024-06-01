<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event details
    $sql = "SELECT * FROM events WHERE event_id=$event_id";
    $result = $conn->query($sql);
    $event = $result->fetch_assoc();

    // Fetch user details
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id=$user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
} else {
    header('Location: package.php');
    exit;
}

// Chapa payment processing
$amount = 100; // Change this to the actual amount
$currency = "ETB";
$email = $user['email'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$phone_number = $user['phone_number'];
$tx_ref = "eventbooking-" . time();
$callback_url = "http://localhost/event_management/user/payment_callback.php";
$return_url = "http://localhost/event_management/user/thank_you.php";
$customization_title = "Payment for event booking";
$customization_description = "Booking for event: " . $event['event_name'];

$ch = curl_init();

curl_setopt_array($ch, array(
  CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode(array(
    "amount" => $amount,
    "currency" => $currency,
    "email" => $email,
    "first_name" => $first_name,
    "last_name" => $last_name,
    "phone_number" => $phone_number,
    "tx_ref" => $tx_ref,
    "callback_url" => $callback_url,
    "return_url" => $return_url,
    "customization" => array(
      "title" => $customization_title,
      "description" => $customization_description
    )
  )),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer CHASECK-xxxxxxxxxxxxxxxx',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($ch);
curl_close($ch);
$response_data = json_decode($response, true);

if ($response_data['status'] === 'success') {
    $checkout_url = $response_data['data']['checkout_url'];
    header("Location: $checkout_url");
    exit;
} else {
    echo "Error initializing payment: " . $response_data['message'];
}

$conn->close();
include('../includes/footer.php');
?>
