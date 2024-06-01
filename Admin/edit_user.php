<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', password='$password', role='$role' WHERE user_id=$user_id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: manage_users.php');
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id=$user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        header('Location: manage_users.php');
        exit;
    }
} else {
    header('Location: manage_users.php');
    exit;
}

?>
<div class="content">
    <h2>Edit User</h2>
    <form method="post" action="edit_user.php">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>
        <br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="manager" <?php if ($user['role'] == 'manager') echo 'selected'; ?>>Manager</option>
            <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
        </select>
        <br>
        <button type="submit">Update User</button>
    </form>
</div>
<?php
include('../includes/footer.php');
?>
