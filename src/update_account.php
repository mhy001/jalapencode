<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'];

$sql = "SELECT * FROM account WHERE username = '{$username}'";
$result = $conn->query($sql);
if(!$result){
    echo "Fail to execute: " . $sql . $conn->error . "<br />";
}else{
    $row = $result->fetch_assoc();
}
if(isset($_POST['update_submit'])){
    $fname = $conn->real_escape_string($_POST['firstname']);
    $lname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $address2 = $conn->real_escape_string($_POST['address2']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $zip = $conn->real_escape_string($_POST['zip']);
    // handle separately from the rest
    //$username = $conn->real_escape_string($_POST['username']);
    //$password = $conn->real_escape_string($_POST['password']);
    
    if(!empty($fname) && $fname != $row['fname']){
        $sql = "UPDATE account SET fname = '{$fname}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($lname) && $lname != $row['lname']){
        $sql = "UPDATE account SET lname = '{$lname}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($email) && $email != $row['email']){
        $sql = "UPDATE account SET email = '{$email}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($address) && $address != $row['addr']){
        $sql = "UPDATE account SET addr = '{$address}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($address2) && $address2 != $row['addr_2']){
        $sql = "UPDATE account SET addr_2 = '{$address2}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($city) && $city != $row['addr_city']){
        $sql = "UPDATE account SET addr_city = '{$city}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($state) && $state != $row['addr_state']){
        $sql = "UPDATE account SET addr_state = '{$state}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    if(!empty($zip) && $zip != $row['addr_zipcode']){
        $sql = "UPDATE account SET addr_zipcode = '{$zip}' WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }
    }
    
    header("Location: /account_setting");
    
}else{
    header("Location: /");
}


?>
