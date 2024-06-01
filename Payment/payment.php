<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "payment_gateway";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mock payment processing endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $amount = $requestData['amount'];
    $cardNumber = $requestData['cardNumber'];
    $expiry = $requestData['expiry'];
    $cvv = $requestData['cvv'];
    $userId = 1; // Assuming we are dealing with user ID 1 for this example

    // Fetch user balance from the database
    $sql = "SELECT balance FROM users WHERE id = $userId";
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
                $updateSql = "UPDATE users SET balance = $newBalance WHERE id = $userId";
                
                if ($conn->query($updateSql) === TRUE) {
                    // Simulate successful payment
                    $response = array('status' => 'success', 'message' => "Payment of $$amount processed successfully. Remaining balance: $$newBalance.");
                    http_response_code(200);
                    echo json_encode($response);
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
