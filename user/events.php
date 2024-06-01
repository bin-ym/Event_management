<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch events for the category
    $sql = "SELECT * FROM packages WHERE category_id=$category_id";
    $result = $conn->query($sql);
} else {
    header('Location: package.php');
    exit;
}

?>
<div class="content">
    <h2>Events</h2>
    <div class="events">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event'>
                        <h3>{$row['package_name']}</h3>
                        <p>Date: {$row['start_date']}</p>
                        <a href='book_event.php?package_id={$row['package_id']}'>Book Now</a>
                    </div>";
            }
        } else {
            echo "<p>No events found.</p>";
        }
        ?>
    </div>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
