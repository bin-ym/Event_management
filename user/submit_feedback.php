<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

$user_id = $_SESSION['user_id'];
$message = $_POST['message'];

$sql = "INSERT INTO feedback (user_id, message) VALUES ('$user_id', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Feedback submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: feedback.php');
exit;
?>
