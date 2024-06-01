<?php
session_start();
if ($_SESSION['user_role'] != 'manager') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_report'])) {
    $manager_id = $_SESSION['user_id'];
    $package_id = $_POST['package_id'];
    $report = $_POST['report'];

    $sql = "INSERT INTO event_reports (manager_id, package_id, report) VALUES ('$manager_id', '$package_id', '$report')";

    if ($conn->query($sql) === TRUE) {
        header('Location: report.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch packages assigned to the manager
$manager_id = $_SESSION['user_id'];
$sql = "SELECT * FROM packages WHERE manager_id=$manager_id";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>Submit Report</h2>
    <form method="post" action="report.php">
        <label for="package_id">Package:</label>
        <select id="package_id" name="package_id" required>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['package_id']}'>{$row['package_name']}</option>";
                }
            } else {
                echo "<option value=''>No packages found</option>";
            }
            ?>
        </select>
        <br>
        <label for="report">Report:</label>
        <textarea id="report" name="report" required></textarea>
        <br>
        <button type="submit" name="submit_report">Submit Report</button>
    </form>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
