<?php
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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $room_no = $_POST['room_no'];
    $visit_place = mysqli_real_escape_string($conn, $_POST['visit_place']);
    $block_name = mysqli_real_escape_string($conn, $_POST['block_name']);
    $date_leave = $_POST['date_leave'];
    $out_time = $_POST['out_time'];
    $date_return = $_POST['date_return'];
    $no_leave = $_POST['no_leave'];
    $student_mno = $_POST['student_mno'];
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $rector_password = $_POST['password'];

    // Check if the rector password is correct
    $rector_password_query = "SELECT password FROM rector_password WHERE password = '$rector_password'";
    $result = $conn->query($rector_password_query);

    if ($result->num_rows > 0) {
        // Rector password found, proceed with generating QR code
        // SQL to insert data into table
        $sql = "INSERT INTO student_detail (name, reason, room_no, visit_place, block_name, date_leave, out_time, date_return, no_leave, student_mno, course) VALUES ('$name', '$reason', '$room_no', '$visit_place', '$block_name', '$date_leave', '$out_time', '$date_return', '$no_leave', '$student_mno', '$course')";
        
        if ($conn->query($sql) === TRUE) {       
            // Redirect to qr.php with URL parameters
            $urlParams = http_build_query([
                'name' => $name,
                'reason' => $reason,
                'room_no' => $room_no,
                'visit_place' => $visit_place,
                'block_name' => $block_name,
                'date_leave' => $date_leave,
                'out_time' => $out_time,
                'date_return' => $date_return,
                'no_leave' => $no_leave,
                'student_mno' => $student_mno,
                'course' => $course
            ]);
            header("Location: qr.php?$urlParams");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Rector password is incorrect
        echo "Rector password is incorrect.";
    }
} else {
    // Method is not POST
    echo "Method is not POST.";
}

// Close connection
$conn->close();
?>
