<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $package_name = $_POST['package_name'];
    $level = $_POST['level'];
    $description = $_POST['description'];
    $status = 'pending';

    $sql = "INSERT INTO user_package (user_id, package_name, level, description, status) 
            VALUES ('$user_id', '$package_name', '$level', '$description', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Package request submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: set_package.php');
    exit;
}

// Fetch user packages
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_package WHERE user_id = $user_id";
$result = $conn->query($sql);

?>
<div class="content">
    <h2>Set Package</h2>
    <form method="post" action="set_package.php">
        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" required>
        <br>
        <label for="level">Level:</label>
        <select id="level" name="level" required>
            <option value="silver">Silver</option>
            <option value="gold">Gold</option>
            <option value="platinum">Platinum</option>
        </select>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <button type="submit">Submit Package Request</button>
    </form>
    <h3>Package Requests</h3>
    <table>
        <tr>
            <th>Package Name</th>
            <th>Level</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['package_name']}</td>
                        <td>{$row['level']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['status']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No package requests found.</td></tr>";
        }
        ?>
    </table>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
