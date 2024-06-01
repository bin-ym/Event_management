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
    $category_name = $_POST['category_name'];
    $package_details = $_POST['package_details'];

    $sql = "UPDATE categories SET category_name='$category_name', package_details='$package_details' WHERE category_id=$category_id";

    if ($conn->query($sql) === TRUE) {
        echo "Category updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: manage_categories.php');
    exit;
}

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "SELECT * FROM categories WHERE category_id=$category_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $category = $result->fetch_assoc();
    } else {
        header('Location: manage_categories.php');
        exit;
    }
} else {
    header('Location: manage_categories.php');
    exit;
}

?>
<div class="content">
    <h2>Edit Category</h2>
    <form method="post" action="edit_category.php">
        <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="<?php echo $category['category_name']; ?>" required>
        <br>
        <label for="package_details">Package Details:</label>
        <textarea id="package_details" name="package_details" required><?php echo $category['package_details']; ?></textarea>
        <br>
        <button type="submit">Update Category</button>
    </form>
</div>
<?php
include('../includes/footer.php');
?>
