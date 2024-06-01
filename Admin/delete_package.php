<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from bookings table first
        $sql = "DELETE FROM bookings WHERE package_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $package_id);
        $stmt->execute();
        $stmt->close();
        
        // Now delete from packages table
        $sql = "DELETE FROM packages WHERE package_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $package_id);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $conn->commit();

        echo "Package deleted successfully";
    } catch (Exception $e) {
        // Rollback transaction if something failed
        $conn->rollback();

        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
header('Location: manage_categories.php');
exit;
?>
