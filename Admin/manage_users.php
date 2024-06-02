<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "User added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch users
$sql = "SELECT * FROM users WHERE role != 'admin'";
$result = $conn->query($sql);

?>
<div class="content">
    <h2>Manage Users</h2>
    <h3>Add New User</h3>
    <form method="post" action="manage_users.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="manager">Manager</option>
            <option value="user">User</option>
        </select>        
        <button type="submit" name="add_user">Add User</button>
    </form>

    <h3>Existing Users</h3>
    <table>
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['username']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['user_id']}'>Edit</a>
                            <a href='delete_user.php?id={$row['user_id']}'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found.</td></tr>";
        }
        ?>
    </table>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
