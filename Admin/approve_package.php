<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];

    // Approve the package
    $sql = "UPDATE packages SET status='active' WHERE package_id=$package_id";
    if ($conn->query($sql) === TRUE) {
        header('Location: manage_user_packages.php');
    } else {
        echo "Error updating package: " . $conn->error;
    }
} else {
    header('Location: manage_user_packages.php');
}

$conn->close();
?>
