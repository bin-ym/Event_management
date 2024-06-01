<?php
session_start();
if ($_SESSION['user_role'] != 'manager') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
?>
<div class="content">
    <h2>Manager Dashboard</h2>
    <p>Welcome, Manager!</p>
</div>
<?php
include('../includes/footer.php');
?>
