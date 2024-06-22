<?php
if(isset($_GET['qrData']) && !empty($_GET['qrData'])) {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "get_pass";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve QR code data and sanitize it
    $qrData = $conn->real_escape_string($_GET['qrData']);

    // Insert QR code data into scannerdata table
    $sql = "INSERT INTO scannerdata (qrData) VALUES ('$qrData')";

    if ($conn->query($sql) === TRUE) {
        echo "QR Code data inserted successfully into scannerdata table";
    } else {
        // Check if it's a duplicate entry error
        if ($conn->errno == 1062) {
            echo "Duplicate entry error: The QR Code data already exists in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid or empty QR code data.";
}
?>