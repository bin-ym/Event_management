<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

$category_name = $_POST['category_name'];
$package_details = $_POST['package_details'];

$sql = "INSERT INTO categories (category_name, package_details) VALUES ('$category_name', '$package_details')";

if ($conn->query($sql) === TRUE) {
    echo "New category created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: manage_categories.php');
exit;
?>
