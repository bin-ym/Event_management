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

    // Fetch packages for the selected category
    $sql = "SELECT * FROM packages WHERE category_id = $category_id";
    $result = $conn->query($sql);
    ?>
    <div class="content">
        <h2>Packages</h2>
        <div class="packages">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='package'>
                            <h3>{$row['package_name']}</h3>
                            <p>{$row['description']}</p>
                            <p>Level: {$row['level']}</p>
                            <p>Price: {$row['price']} Br</p>
                            <a href='payment.html?package_id={$row['package_id']}&price={$row['price']}'>Book Now</a>
                          </div>";
                }
            } else {
                echo "<p>No packages found for this category.</p>";
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo "<p>Invalid category selection.</p>";
}

$conn->close();
include('../includes/footer.php');
?>
