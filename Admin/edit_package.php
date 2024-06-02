<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_package'])) {
        $package_name = $_POST['package_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $sql = "UPDATE packages SET package_name='$package_name', description='$description', price='$price' WHERE package_id=$package_id";
        if ($conn->query($sql) === TRUE) {
            header('Location: manage_categories.php?success=1');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM packages WHERE package_id=$package_id";
    $result = $conn->query($sql);
    $package = $result->fetch_assoc();
} else {
    header('Location: manage_categories.php');
    exit;
}
?>

<div class="content">
    <h2>Edit Package</h2>
    <form method="post" action="edit_package.php?id=<?php echo $package_id; ?>">
        <label for="package_name">Package Name:</label>
        <input type="text" id="package_name" name="package_name" value="<?php echo $package['package_name']; ?>" required>
        <br>
        <label for="description">Details:</label>
        <textarea id="description" name="description" required><?php echo $package['description']; ?></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $package['price']; ?>" required>
        <br>
        <button type="submit" name="update_package">Update Package</button>
    </form>
</div>
<?php
$conn->close();
include('../includes/footer.php');
?>
