<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch packages
$sql = "SELECT package_id, package_name FROM packages";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>Feedback</h2>
    <form method="post" action="submit_feedback.php">
        <label for="package">Package:</label>
        <select id="package" name="package_id" required>
            <option value="">Select a package</option>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['package_id']}'>{$row['package_name']}</option>";
                }
            } else {
                echo "<option value='' disabled>No packages available</option>";
            }
            ?>
        </select>
        <br>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>
</div>
<?php
include('../includes/footer.php');
?>
