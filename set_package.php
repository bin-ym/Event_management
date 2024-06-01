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
    $category_id = $_POST['category_id'];
    $package_name = $_POST['package_name'];
    $level = $_POST['level'];
    $manager_id = $_POST['manager_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO packages (category_id, package_name, level, manager_id, start_date, end_date, description, price) VALUES ('$category_id', '$package_name', '$level', '$manager_id', '$start_date', '$end_date', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Package set successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: manage_categories.php');
    exit;
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
} else {
    header('Location: manage_categories.php');
    exit;
}

// Fetch managers
$sql = "SELECT * FROM managers";
$result = $conn->query($sql);

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
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['manager_id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>No managers found</option>";
            }
            ?>
        </select>
        <br>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" min="<?php echo date('Y-m-d'); ?>" required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" min="<?php echo date('Y-m-d'); ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        <br>
        <button type="submit">Set Package</button>
    </form>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
