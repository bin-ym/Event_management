<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

$user_id = $_SESSION['user_id'];
$deposit_amount = $_POST['deposit_amount'];

$sql = "UPDATE user_balance SET balance = balance + $deposit_amount WHERE user_id = $user_id";

if ($conn->query($sql) === TRUE) {
    header('Location: profile.php');
} else {
    echo "Error depositing balance: " . $conn->error;
}

$conn->close();
?>
