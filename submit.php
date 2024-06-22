<?php
if (isset($_GET['qrData'])) {
    $qrData = $_GET['qrData'];

    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "get_pass";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the QR data already exists in the database
    $sql = "SELECT * FROM scannerData WHERE qr_data = '$qrData'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // QR code already scanned
        $response = array("success" => false, "message" => "This QR code has already been scanned. No action taken.", "data" => null);
    } else {
        // Insert the QR data into the database
        $sql = "INSERT INTO scannerData (qr_data) VALUES ('$qrData')";
        if ($conn->query($sql) === TRUE) {
            $response = array("success" => true, "message" => "Data successfully submitted to the database.", "data" => $qrData);
        } else {
            $response = array("success" => false, "message" => "Failed to submit data to the database.", "data" => null);
        }
    }

    $conn->close();
} else {
    $response = array("success" => false, "message" => "No QR code data received.", "data" => null);
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
