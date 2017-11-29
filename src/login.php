<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 3d1b913aef98888efe9975e1f2510e33e38708e5
>>>>>>> d4f774a5776059c2d1b2785d9d88f28968dc5164
/*
echo "<pre>";
var_dump($_SESSION['visited']);
echo "</pre>";
*/
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
echo "<pre>";
var_dump($_SESSION['visited']);
echo "</pre>";

>>>>>>> 8e3ba6f848a1fc7d2b7c5ef0ce2ea657d51e3808
>>>>>>> 3d1b913aef98888efe9975e1f2510e33e38708e5
>>>>>>> d4f774a5776059c2d1b2785d9d88f28968dc5164
if(isset($_POST['login-submit'])){
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    if(empty($username) || empty($password)){
        echo "Username/Password is empty";
    }else{
        $sql = "SELECT * FROM account WHERE username = '{$username}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }else{
            if($result->num_rows < 1){
                echo "username doesnt exist";
            }else if($result->num_rows > 1){
                echo "Why are there 2 of the same username??????";
            }else{
                $row = $result->fetch_assoc();
                // redundant check, but meh
                if($username != $row['username']){
                    echo "Invalid username";
                }else{
                    // Username is valid, now we check for password
                    if($password != $row['password']){
                        echo "Invalid password";
                    }else{
                        // Username and password are correct
                        
                        
                        $_SESSION['username'] = $username;
                        array_pop($_SESSION['visited']);
                        $test = end($_SESSION['visited']);
                        echo $test;
                        // TODO: instead of going to the index page, go to the page beofore log in
<<<<<<< HEAD
                        header("Location: / ");
=======
<<<<<<< HEAD
                        header("Location: / ");
=======
<<<<<<< HEAD
                        header("Location: / ");
=======
                        header("Location: /");
>>>>>>> 8e3ba6f848a1fc7d2b7c5ef0ce2ea657d51e3808
>>>>>>> 3d1b913aef98888efe9975e1f2510e33e38708e5
>>>>>>> d4f774a5776059c2d1b2785d9d88f28968dc5164
                    }
                }
            }
        }
        
    }
}

?>