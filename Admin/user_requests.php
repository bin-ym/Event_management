<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch user package requests
$sql = "SELECT up.*, u.username as user_name 
        FROM user_package up
        JOIN users u ON up.user_id = u.user_id";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>User Package Requests</h2>
    <table>
        <tr>
            <th>User Name</th>
            <th>Package Name</th>
            <th>Level</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['user_name']}</td>
                        <td>{$row['package_name']}</td>
                        <td>{$row['level']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <a href='approve_request.php?id={$row['user_package_id']}'>Approve</a>
                            <a href='reject_request.php?id={$row['user_package_id']}'>Reject</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No user requests found.</td></tr>";
        }
        ?>
    </table>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
