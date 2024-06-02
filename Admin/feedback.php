<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch feedback
$sql = "SELECT feedback.message, users.username 
        FROM feedback 
        JOIN users ON feedback.user_id = users.user_id";
$result = $conn->query($sql);
?>
<div class="content">
    <h2>User Feedback</h2>
    <table>
        <tr>
            <th>User</th>
            <th>Feedback</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['username']}</td>
                        <td>{$row['message']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No feedback found.</td></tr>";
        }
        ?>
    </table>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
