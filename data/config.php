<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "1234";


$conn = new mysqli($dbhost, $dbuser, $dbpass);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . " " . $conn->connect_errno);
    }else{
        //echo "Connected successfully<br />";
    }


?>
