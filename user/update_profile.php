<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header('Location: ../index.php');
    exit;
}

include('../includes/db.php');

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "UPDATE users SET username = '$username'";

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql .= ", password = '$hashed_password'";
}

$sql .= " WHERE user_id = $user_id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $username;
    header('Location: profile.php');
} else {
    echo "Error updating profile: " . $conn->error;
}

$conn->close();
?>
