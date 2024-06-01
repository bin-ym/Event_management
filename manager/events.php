<?php
session_start();
if ($_SESSION['user_role'] != 'manager') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch events assigned to the manager
$manager_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT package_id, package_name, start_date FROM packages WHERE manager_id = ?");
$stmt->bind_param("i", $manager_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="content">
    <h2>My Events</h2>
    <table>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['package_id']}</td>
                        <td>{$row['package_name']}</td>
                        <td>{$row['start_date']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No events found.</td></tr>";
        }
        ?>
    </table>
</div>

<?php
$stmt->close();
$conn->close();
include('../includes/footer.php');
?>
