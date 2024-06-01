<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
?>
<div class="content">
    <h2>User Dashboard</h2>
    <p>Welcome, User!</p>
</div>
<?php
include('../includes/footer.php');
?>
