<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "get_pass";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT * FROM rector_password WHERE name='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $update_sql = "UPDATE rector_password SET password='$new_password' WHERE name='$username'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Password changed successfully!";
        } else {
            echo "Failed to change password.";
        }
    } else {
        echo "Username not found.";
    }
}

$conn->close();
?>
