<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the status to rejected
    $sql = "UPDATE user_package SET status='rejected' WHERE user_package_id='$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: user_requests.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
