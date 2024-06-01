<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

$user_id = $_SESSION['user_id'];
$details = $_POST['details'];

$sql = "INSERT INTO packages (user_id, details) VALUES ('$user_id', '$details')";

if ($conn->query($sql) === TRUE) {
    echo "Package saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: package.php');
exit;
?>
