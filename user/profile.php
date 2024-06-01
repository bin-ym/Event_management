<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT username, balance FROM users JOIN user_balance ON users.user_id = user_balance.user_id WHERE users.user_id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<div class="content">
    <h2>Profile Management</h2>
    
    <form action="update_profile.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">

        <button type="submit">Update Profile</button>
    </form>
    
    <h3>Account Balance: $<?php echo number_format($user['balance'], 2); ?></h3>
    
    <form action="deposit_balance.php" method="post">
        <label for="deposit_amount">Deposit Amount:</label>
        <input type="number" id="deposit_amount" name="deposit_amount" required>
        
        <button type="submit">Deposit</button>
    </form>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
