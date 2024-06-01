<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php');
    exit;
}

include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $package_details = $_POST['package_details'];
    
    // Handle image upload
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["image"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
            $image = "";
        }
    } else {
        echo "File is not an image.";
        $image = "";
    }

    $sql = "INSERT INTO categories (category_name, package_details, image) VALUES ('$category_name', '$package_details', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Category added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch categories
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>
<style>
    .flex-container {
        display: flex;
    }
    .flex-container .content {
        width: 50%;
        padding: 10px;
    }
    .category-image {
        width: 50px;
        height: 50px;
    }
    .centered-table {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div class="flex-container">
    <div class="content">
        <h2>Add New Category</h2>
        <form method="post" action="manage_categories.php" enctype="multipart/form-data">
            <label for="category_name">Category Name:</label>
            <input type="text" id="category_name" name="category_name" required>
            <br>
            <label for="package_details">Package Details:</label>
            <textarea id="package_details" name="package_details" required></textarea>
            <br>
            <label for="image">Category Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <br>
            <button type="submit" name="add_category">Add Category</button>
        </form>
    </div>
    <div>
    <h2>Packages by Category</h2>
<?php
// Fetch categories with packages
$sql = "SELECT * FROM categories";
$categories = $conn->query($sql);

if ($categories->num_rows > 0) {
    while ($category = $categories->fetch_assoc()) {
        $category_id = $category['category_id'];
        $category_name = $category['category_name'];

        echo "<h3>Packages for Category: $category_name</h3>";

        // Fetch packages for this category
        $sql = "SELECT * FROM packages WHERE category_id=$category_id";
        $packages = $conn->query($sql);

        if ($packages->num_rows > 0) {
            echo "<table class='centered-table'>
                    <tr>
                        <th>Package Name</th>
                        <th>Details</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>";
            while ($package = $packages->fetch_assoc()) {
                echo "<tr>
                        <td>{$package['package_name']}</td>
                        <td>{$package['description']}</td>
                        <td>{$package['price']} ETB</td>
                        <td>
                            <a href='edit_package.php?id={$package['package_id']}'>Edit</a>
                            <a href='delete_package.php?id={$package['package_id']}'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No packages found for this category.</p>";
        }
    }
} else {
    echo "<p>No categories found.</p>";
}
$conn->close();
include('../includes/footer.php');
?>
    </div>

    <div class="content">
        <h2>Existing Categories</h2>
        <table class="centered-table">
            <tr>
                <th>Category Name</th>
                <th>Package Details</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['category_name']}</td>
                            <td>{$row['package_details']}</td>
                            <td><img src='../images/{$row['image']}' alt='{$row['category_name']}' class='category-image'></td>
                            <td>
                                <a href='edit_category.php?id={$row['category_id']}'>Edit</a>
                                <a href='delete_category.php?id={$row['category_id']}'>Delete</a>
                                <a href='set_package.php?category_id={$row['category_id']}'>Set Package</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No categories found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>


