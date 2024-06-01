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
    // Validate and sanitize input data
    $category_id = $_POST['category_id'];
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $level = $_POST['level'];
    $manager_id = $_POST['manager_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];

    // Insert package into the database
    $sql = "INSERT INTO packages (category_id, package_name, level, manager_id, start_date, end_date, description, price) VALUES ('$category_id', '$package_name', '$level', '$manager_id', '$start_date', '$end_date', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        // Package set successfully, redirect to manage_categories.php
        header('Location: manage_categories.php?success=1');
        exit;
    } else {
        // Error occurred, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}

// Get category ID from URL parameter
$category_id = $_GET['category_id'];
?>

<div class="content">
    <h2>Set Package</h2>
    <form method="post" action="set_package.php">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
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
        <label for="manager_id">Assign to Manager:</label>
        <select id="manager_id" name="manager_id" required>
            <?php
            // Fetch managers from users table where role is 'manager'
            $managers_sql = "SELECT user_id, username FROM users WHERE role = 'manager'";
            $managers_result = $conn->query($managers_sql);
            if ($managers_result->num_rows > 0) {
                while ($manager = $managers_result->fetch_assoc()) {
                    echo "<option value='{$manager['user_id']}'>{$manager['username']}</option>";
                }
            } else {
                echo "<option value=''>No managers found</option>";
            }
            ?>
        </select>
        <br>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <br>
        <button type="submit">Set Package</button>
    </form>
</div>

<?php
include('../includes/footer.php');
?>
