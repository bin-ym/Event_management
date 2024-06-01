<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>
<div class="content">
    <h2>Admin Dashboard</h2>
    <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
</div>
<?php
include('../includes/footer.php');
?>
