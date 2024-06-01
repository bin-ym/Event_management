<?php
session_start();
include('../includes/db.php');

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set content type to JSON
header('Content-Type: application/json');

// Deposit processing endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid JSON input.'));
        exit;
    }

    $amount = $requestData['amount'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

    if (!is_numeric($amount) || $amount <= 0) {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid deposit amount.'));
        exit;
    }

    // Fetch user balance from the database
    $sql = "SELECT balance FROM user_balance WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode(array('status' => 'error', 'message' => 'Database query error: ' . $conn->error));
        exit;
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentBalance = $row['balance'];

        // Add deposit amount to current balance
        $newBalance = $currentBalance + $amount;
        $updateSql = "UPDATE user_balance SET balance = $newBalance WHERE user_id = $user_id";

        if ($conn->query($updateSql) === TRUE) {
            $response = array('status' => 'success', 'message' => "Deposit of $$amount was successful. New balance: $$newBalance.");
            http_response_code(200);
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'Could not update balance.');
            http_response_code(500);
            echo json_encode($response);
        }
    } else {
        // If user balance record does not exist, create one
        $insertSql = "INSERT INTO user_balance (user_id, balance) VALUES ($user_id, $amount)";
        if ($conn->query($insertSql) === TRUE) {
            $response = array('status' => 'success', 'message' => "Deposit of $$amount was successful. New balance: $$amount.");
            http_response_code(200);
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'message' => 'Could not create balance record.');
            http_response_code(500);
            echo json_encode($response);
        }
    }
}

$conn->close();
?>
