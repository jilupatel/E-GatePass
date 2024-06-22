<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your database connection and data insertion code here
    // Example:
    // $name = $_POST['name'];
    // $reason = $_POST['reason'];
    // $room_no = $_POST['room_no'];
    // ...
    // Perform database insertion based on the received data
    // Remember to sanitize and validate the input data to prevent SQL injection and other security vulnerabilities

    // Sample response
    $response = array("success" => true, "message" => "Data successfully submitted to the database.");
} else {
    $response = array("success" => false, "message" => "No POST data received.");
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
