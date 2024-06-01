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
    <h2>Feedback</h2>
    <form method="post" action="submit_feedback.php">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>
</div>
<?php
include('../includes/footer.php');
?>
