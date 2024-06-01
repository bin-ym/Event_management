<?php
session_start();
include('../includes/db.php');

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Mock payment processing endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $requestData = json_decode(file_get_contents('php://input'), true);

    $amount = $requestData['amount'];
    $cardNumber = $requestData['cardNumber'];
    $expiry = $requestData['expiry'];
    $cvv = $requestData['cvv'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session
    $package_id = $requestData['package_id'];

    // Fetch user balance from the database
    $sql = "SELECT balance FROM user_balance WHERE user_id = $user_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance = $row['balance'];

        // Simulate payment processing
        if (isValidCardNumber($cardNumber) && isValidExpiry($expiry) && isValidCVV($cvv)) {
            if ($amount > $balance) {
                // Simulate insufficient balance
                $response = array('status' => 'error', 'message' => 'Payment failed due to insufficient balance.');
                http_response_code(400);
                echo json_encode($response);
            } else {
                // Deduct amount from balance
                $newBalance = $balance - $amount;
                $updateSql = "UPDATE user_balance SET balance = $newBalance WHERE user_id = $user_id";
                
                if ($conn->query($updateSql) === TRUE) {
                    // Simulate successful payment
                    // Store booking information
                    $bookingDate = date('Y-m-d H:i:s');
                    $status = 'confirmed';
                    $insertSql = "INSERT INTO bookings (user_id, package_id, booking_date, status) VALUES ($user_id, $package_id, '$bookingDate', '$status')";
                    
                    if ($conn->query($insertSql) === TRUE) {
                        $response = array('status' => 'success', 'message' => "Payment of $$amount processed successfully. Remaining balance: $$newBalance.");
                        http_response_code(200);
                        echo json_encode($response);
                    } else {
                        $response = array('status' => 'error', 'message' => 'Booking processing failed.');
                        http_response_code(500);
                        echo json_encode($response);
                    }
                } else {
                    // Handle update failure
                    $response = array('status' => 'error', 'message' => 'Payment processing failed. Could not update balance.');
                    http_response_code(500);
                    echo json_encode($response);
                }
            }
        } else {
            // Simulate payment failure due to invalid card details
            $response = array('status' => 'error', 'message' => 'Payment processing failed. Please check your payment details.');
            http_response_code(400);
            echo json_encode($response);
        }
    } else {
        // Handle user not found
        $response = array('status' => 'error', 'message' => 'User not found.');
        http_response_code(404);
        echo json_encode($response);
    }
}

// Helper functions to validate card details
function isValidCardNumber($cardNumber) {
    // Simulate basic card number validation (16 digits)
    return strlen($cardNumber) === 4 && is_numeric($cardNumber);
}

function isValidExpiry($expiry) {
    // Simulate expiry date validation (MM/YY format)
    return preg_match('/^\d{2}\/\d{2}$/', $expiry);
}

function isValidCVV($cvv) {
    // Simulate CVV validation (3 digits)
    return preg_match('/^\d{3}$/', $cvv);
}

$conn->close();
?>
