<?php
session_start();
include('../includes/db.php');

// Get payment details from Chapa callback
$response = file_get_contents('php://input');
$response_data = json_decode($response, true);

// Verify payment status
if ($response_data['status'] == 'success') {
    $tx_ref = $response_data['data']['tx_ref'];
    $status = $response_data['data']['status'];

    // Update booking status in the database
    $sql = "UPDATE bookings SET status='$status' WHERE tx_ref='$tx_ref'";
    if ($conn->query($sql) === TRUE) {
        echo "Payment successful and booking status updated.";
    } else {
        echo "Error updating booking status: " . $conn->error;
    }
} else {
    echo "Payment failed.";
}

$conn->close();
?>
