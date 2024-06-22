<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "get_pass";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM rector_password WHERE name='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header("Location: options.html");
} else {
    header("Location: login.html");
}

mysqli_close($conn);
?>
