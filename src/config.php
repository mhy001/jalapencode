<?php

require_once('../data/config.php');

$dbname = "jalapeno";

    $conn->select_db($dbname);
    // Select database
    if($conn->error){
        die("Cannot select database " . $conn->error);
    }else{
        //echo "Database selected";
    }

?>
