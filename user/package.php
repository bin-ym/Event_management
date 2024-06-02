<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>Packages</h2>
    <div class="categories">
        <?php
        if ($result->num_rows > 0) {
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                if ($count % 3 == 0) echo "<div class='row'>";
                echo "<div class='category'>
                        <img src='../images/{$row['image']}' alt='{$row['category_name']}' style='width: 50vh; height: auto;'>
                        <h3>{$row['category_name']}</h3>
                        <p>{$row['package_details']}</p>
                        <a href='view_packages.php?category_id={$row['category_id']}'>View Packages</a>
                    </div>";
                $count++;
                if ($count % 3 == 0) echo "</div>";
            }
            if ($count % 3 != 0) echo "</div>"; // Close the last row if not closed
        } else {
            echo "<p>No categories found.</p>";
        }
        ?>
    </div>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
