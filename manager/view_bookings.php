<?php
session_start();
if ($_SESSION['user_role'] != 'manager') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

$manager_id = $_SESSION['user_id'];
$sql = "SELECT b.*, p.package_name 
        FROM bookings b
        JOIN packages p ON b.package_id = p.package_id
        WHERE p.manager_id = $manager_id";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>Your Bookings</h2>
    <div class="bookings">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='booking'>
                        <h3>Package: {$row['package_name']}</h3>
                        <p>Date: {$row['booking_date']}</p>
                        <p>Status: {$row['status']}</p>
                      </div>";
            }
        } else {
            echo "<p>No bookings found.</p>";
        }
        ?>
    </div>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
