<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "get_pass";
    
        $conn = mysqli_connect("localhost", "root", "", "get_pass");
        // // set the PDO error mode to exception
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "";
        if (!$conn) {
            die("connection faild: " . mysqli_connect_error());
        }
        $name=$_POST['name'];
        $password=$_POST['password'];

        $data = "INSERT INTO rector_password (name, password) VALUES ('$name', '$password')";
        $check = mysqli_query($conn,$data);
        // $check = $conn->query($data);
        if($check){
            echo "Data transferred sucessfully";
        }
        else{
            echo "Faild";
        }
?>