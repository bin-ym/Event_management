<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if (!isset($_GET['id'])) {
    header('Location: user_requests.php');
    exit;
}

$user_package_id = $_GET['id'];

// Fetch package details from user_package table
$sql = "SELECT up.*, u.username as user_name
        FROM user_package up
        JOIN users u ON up.user_id = u.user_id
        WHERE up.user_package_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_package_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header('Location: user_requests.php');
    exit;
}

$package = $result->fetch_assoc();
$stmt->close();

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $level = $_POST['level'];
    $manager_id = $_POST['manager_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];

    // Check if the category_id exists in the categories table
    $category_check_sql = "SELECT * FROM categories WHERE category_id = ?";
    $category_stmt = $conn->prepare($category_check_sql);
    $category_stmt->bind_param('i', $category_id);
    $category_stmt->execute();
    $category_result = $category_stmt->get_result();

    if ($category_result->num_rows == 0) {
        echo "Error: Invalid category ID.";
    } else {
        $sql = "INSERT INTO packages (category_id, package_name, level, manager_id, start_date, end_date, description, price) 
                VALUES ('$category_id', '$package_name', '$level', '$manager_id', '$start_date', '$end_date', '$description', '$price')";

        if ($conn->query($sql) === TRUE) {
            // Update status to approved in user_package table
            $update_sql = "UPDATE user_package SET status='approved' WHERE user_package_id='$user_package_id'";
            $conn->query($update_sql);

            echo "Package set successfully";
            header('Location: manage_categories.php?success=1');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $category_stmt->close();
    $conn->close();
}
?>

<div class="content">
    <h2>Approve Package Request</h2>
    <form method="post" action="approve_request.php?id=<?php echo $user_package_id; ?>">
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php
            $categories_sql = "SELECT category_id, category_name FROM categories";
            $categories_result = $conn->query($categories_sql);
            if ($categories_result->num_rows > 0) {
                while ($category = $categories_result->fetch_assoc()) {
                    echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                }
            } else {
                echo "<option value=''>No categories found</option>";
            }
            ?>
        </select>
        <br>
        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
        <br>
        <label for="level">Level:</label>
        <select id="level" name="level" required>
            <option value="silver" <?php echo $package['level'] == 'silver' ? 'selected' : ''; ?>>Silver</option>
            <option value="gold" <?php echo $package['level'] == 'gold' ? 'selected' : ''; ?>>Gold</option>
            <option value="platinum" <?php echo $package['level'] == 'platinum' ? 'selected' : ''; ?>>Platinum</option>
        </select>
        <br>
        <label for="manager_id">Assign to Manager:</label>
        <select id="manager_id" name="manager_id" required>
            <?php
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
        <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($package['start_date']); ?>" readonly>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($package['end_date']); ?>" readonly>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($package['description']); ?></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <br>
        <button type="submit">Approve Package</button>
    </form>
</div>

<?php
include('../includes/footer.php');
?>
