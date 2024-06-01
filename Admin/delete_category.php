<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE category_id=$category_id";

    if ($conn->query($sql) === TRUE) {
        echo "Category deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

header('Location: manage_categories.php');
exit;
?>
