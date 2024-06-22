<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <style>
        #qrcode {
            width: 200px; /* Adjust the width as needed */
            height: 200px; /* Adjust the height as needed */
            margin: 0 auto; /* Center the QR code */
        }
        /* button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        } */
    </style>
</head>
<body>
    <h1>QR Code Generator</h1>
    
    <!-- <div class="qr-container"> -->
    <div id="qrcode"></div>
    <!-- <button id="doneBtn">Done</button>
    </div> -->

    <script>
        <?php
        
        // Get the URL parameters
        if(isset($_GET['name'])) {
        // const urlParams = new URLSearchParams(window.location.search);
        // const name = urlParams.get('name');
        // const reason = urlParams.get('reason');
        // const room_no = urlParams.get('room_no');
        // const visit_place = urlParams.get('visit_place');
        // const block_name = urlParams.get('block_name');
        // const date_leave = urlParams.get('date_leave');
        // const out_time = urlParams.get('out_time');
        // const date_return = urlParams.get('date_return');
        // const no_leave = urlParams.get('no_leave');
        // const student_mno = urlParams.get('student_mno');
        // const course = urlParams.get('course');
            $name = $_GET['name'];
            $reason = $_GET['reason'];
            $room_no = $_GET['room_no'];
            $visit_place = $_GET['visit_place'];
            $block_name = $_GET['block_name'];
            $date_leave = $_GET['date_leave'];
            $out_time = $_GET['out_time'];
            $date_return = $_GET['date_return'];
            $no_leave = $_GET['no_leave'];
            $student_mno = $_GET['student_mno'];
            $course = $_GET['course'];
        
        // Combine data into a single string
        // const dataToEncode = `Name: ${name}, Reason: ${reason}, Room No: ${room_no}, Visit Place: ${visit_place}, Block Name: ${block_name}, Date Leave: ${date_leave}, Out Time: ${out_time}, Date Return: ${date_return}, No Leave: ${no_leave}, Student Mobile No: ${student_mno}, Course: ${course}`;

        $dataToEncode = "Name: $name, Reason: $reason, Room No: $room_no, Visit Place: $visit_place, Block Name: $block_name, Date Leave: $date_leave, Out Time: $out_time, Date Return: $date_return, No Leave: $no_leave, Student Mobile No: $student_mno, Course: $course";
        ?>
        // Create a new instance of QRCode.js and specify the target element
        const qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "<?php echo $dataToEncode; ?>",
        });
        <?php } ?>
        // const qrCodeData = "Your QR Code Data"; // Change this to your actual QR code data
        // new QRCode(document.getElementById("qr"), qrCodeData);

        // // Redirect to another page when "Done" button is clicked
        // document.getElementById("doneBtn").addEventListener("click", function() {
        //     window.location.href = "other_page.php?qrData=" + encodeURIComponent(qrCodeData);
        // });
    </script>
</body>
</html>
