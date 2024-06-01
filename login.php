<?php
session_start();
include('includes/db.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_role'] = $row['role'];

    switch ($row['role']) {
        case 'admin':
            header('Location: admin/dashboard.php');
            break;
        case 'manager':
            header('Location: manager/dashboard.php');
            break;
        case 'user':
            header('Location: user/dashboard.php');
            break;
    }
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
