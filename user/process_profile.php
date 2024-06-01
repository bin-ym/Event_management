<?php
session_start();
include('../includes/db.php');

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action == 'edit_username') {
        $username = $conn->real_escape_string($_POST['username']);
        $sql = "UPDATE users SET username = '$username' WHERE user_id = $user_id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Username updated successfully.";
        } else {
            $_SESSION['message'] = "Error updating username: " . $conn->error;
        }

    } elseif ($action == 'update_password') {
        $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$password' WHERE user_id = $user_id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Password updated successfully.";
        } else {
            $_SESSION['message'] = "Error updating password: " . $conn->error;
        }

    } elseif ($action == 'deposit_balance') {
        $amount = floatval($_POST['amount']);
        if ($amount <= 0) {
            $_SESSION['message'] = "Invalid deposit amount.";
        } else {
            $sql_balance = "SELECT balance FROM user_balance WHERE user_id = $user_id";
            $result_balance = $conn->query($sql_balance);
            if ($result_balance->num_rows > 0) {
                $row_balance = $result_balance->fetch_assoc();
                $new_balance = $row_balance['balance'] + $amount;
                $sql_update = "UPDATE user_balance SET balance = $new_balance WHERE user_id = $user_id";
            } else {
                $sql_update = "INSERT INTO user_balance (user_id, balance) VALUES ($user_id, $amount)";
            }
            if ($conn->query($sql_update) === TRUE) {
                $_SESSION['message'] = "Deposit successful. New balance: $" . number_format($new_balance, 2);
            } else {
                $_SESSION['message'] = "Error processing deposit: " . $conn->error;
            }
        }
    }
}

header('Location: profile.php');
exit;

$conn->close();
?>
