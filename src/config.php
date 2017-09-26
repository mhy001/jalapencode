<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "1234";
$dbname = "jalapeno";

$conn = new mysqli($dbhost, $dbuser, $dbpass);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . " " . $conn->connect_errno);
    }else{
        //echo "Connected successfully<br />";
    }

    $conn->select_db($dbname);
    // Select database
    if($conn->error){
        die("Cannot select database " . $conn->error);
    }else{
        //echo "Database selected";
    }

?>
