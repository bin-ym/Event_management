<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

$sql = "SELECT er.*, u.username as manager_name, p.package_name 
        FROM event_reports er
        JOIN users u ON er.manager_id = u.user_id
        JOIN packages p ON er.package_id = p.package_id";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>Event Reports</h2>
    <table>
        <tr>
            <th>Manager Name</th>
            <th>Package Name</th>
            <th>Report</th>
            <th>Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['manager_name']}</td>
                        <td>{$row['package_name']}</td>
                        <td>{$row['report']}</td>
                        <td>{$row['date']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No reports found.</td></tr>";
        }
        ?>
    </table>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
