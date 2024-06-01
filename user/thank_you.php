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
    <h2>Thank You</h2>
    <p>Your booking has been confirmed. Thank you for booking with us.</p>
</div>

<?php
include('../includes/footer.php');
?>
