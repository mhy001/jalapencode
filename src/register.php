<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if user actually click register button
if(isset($_POST['register-submit'])){
    
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $c_password = $conn->real_escape_string($_POST['confirm-password']);
    
    // Check if any of the variable are empty, if true => return back to login page
    if(empty($username) || empty($email) || empty($password) || empty($c_password)){
        header("Location: account");
        exit();
    }else{
        // Check actual input
        if(!preg_match("/^[a-zA-z0-9_]*$/", $username) || !preg_match("/^[a-zA-z0-9_@.]*$/", $email) || 
            !preg_match("/^[a-zA-z0-9]*$/", $password) || !preg_match("/^[a-zA-z0-9]*$/", $c_password)){
            echo "Invalid entry";
            header("Location: account");
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // Check if email is valid
            echo "invalid email";
        }
        else if($c_password !== $password){
            // Check if confirm password is matched with password
            echo "confirm password does not match";
        }else{
            // Check if username already exists
            $sql = "SELECT * FROM account WHERE username = '$username'";
            $result = $conn->query($sql);
            if(!$result){
                echo "Fail to execute: " . $sql . $conn->error . "<br />";
            }
            if($result->num_rows > 0){
                echo "Username exists";
            }else{
                
                // If everything is good, insert into database
                $sql = "INSERT INTO account (username, email, password) VALUES ('{$username}', '{$email}', '{$password}')";
                $result = $conn->query($sql);
                if(!$result){
                    echo "Fail to execute: " . $sql . $conn->error . "<br />";
                }else{
                    echo "New account has been created";
                    $_SESSION['username'] = $username;
                    header("Location: / ");
                }
            }
        }
    }
}else{
    // If user just enters the url then redirect them back to log in page
    header("Location: account");
}

?>