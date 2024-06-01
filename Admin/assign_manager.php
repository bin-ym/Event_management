<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $manager_id = $_POST['manager_id'];

        // Assign package to manager
        $sql = "UPDATE packages SET manager_id=$manager_id WHERE package_id=$package_id";
        if ($conn->query($sql) === TRUE) {
            header('Location: manage_user_packages.php');
            exit;
        } else {
            echo "Error updating package: " . $conn->error;
        }
    }

    // Fetch managers
    $sql = "SELECT * FROM users WHERE role='manager'";
    $managers = $conn->query($sql);
?>
<div class="content">
    <h2>Assign Manager</h2>
    <form method="POST">
        <label for="manager_id">Select Manager:</label>
        <select name="manager_id" id="manager_id">
            <?php while ($manager = $managers->fetch_assoc()) { ?>
                <option value="<?php echo $manager['user_id']; ?>"><?php echo $manager['username']; ?></option>
            <?php } ?>
        </select>
        <button type="submit">Assign</button>
    </form>
</div>
<?php
} else {
    header('Location: manage_user_packages.php');
}
$conn->close();
include('../includes/footer.php');
?>
