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
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Check if the token is valid and not expired
    $sql = "SELECT name FROM password_resets WHERE token='$token' AND expiry > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Update the user's password in the database
        $update_sql = "UPDATE rector_password SET password='$new_password' WHERE email='$email'";
        if ($conn->query($update_sql) === TRUE) {
            // Delete the token after successful password reset
            $delete_sql = "DELETE FROM password_resets WHERE token='$token'";
            $conn->query($delete_sql);
            echo "Password reset successfully!";
        } else {
            echo "Failed to reset password.";
        }
    } else {
        echo "Invalid or expired token.";
    }
}

$conn->close();
?>
