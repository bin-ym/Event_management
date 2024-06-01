<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    $user_id = $_SESSION['user_id'];
    $booking_date = date('Y-m-d H:i:s');
    $status = 'confirmed';

    // Insert booking information into the database
    $sql = "INSERT INTO bookings (user_id, package_id, booking_date, status) VALUES ('$user_id', '$package_id', '$booking_date', '$status')";

    if ($conn->query($sql) === TRUE) {
        $booking_id = $conn->insert_id;

        // Fetch the package details for the receipt
        $package_sql = "SELECT * FROM packages WHERE package_id = $package_id";
        $package_result = $conn->query($package_sql);
        $package = $package_result->fetch_assoc();

        // Display the receipt
        echo "<div class='content'>
                <h2>Booking Confirmation Receipt</h2>
                <p>Booking ID: $booking_id</p>
                <p>User ID: $user_id</p>
                <p>Package: {$package['package_name']}</p>
                <p>Details: {$package['description']}</p>
                <p>Level: {$package['level']}</p>
                <p>Price: \${$package['price']}</p>
                <p>Booking Date: $booking_date</p>
                <p>Status: $status</p>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
include('../includes/footer.php');
?>
