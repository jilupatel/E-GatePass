<?php
session_start();

if (!isset($_SESSION['username'])) {
    die("You are not logged in!");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "get_pass";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

// SQL query to check current password
$sql = "SELECT * FROM rector_password WHERE name='$username' AND password='$current_password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    // Correct current password, update the password
    $update_sql = "UPDATE rector_password SET password='$new_password' WHERE name='$username'";
    if (mysqli_query($conn, $update_sql)) {
        echo "Password changed successfully!";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
} else {
    echo "Incorrect current password!";
}

mysqli_close($conn);
?>
