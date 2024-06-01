<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch managers
$sql = "SELECT * FROM managers";
$result = $conn->query($sql);

?>
<div class="content">
    <h2>Manage Managers</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Manager ID: " . $row["manager_id"]. " - Name: " . $row["name"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>
<?php
include('../includes/footer.php');
?>
