<?php 

echo "<h1>Transaction History</h1>";
echo "<hr />";



$sql = "SELECT * FROM session WHERE account_id = {$_SESSION['user_id']}";
$result = $conn->query($sql);

if(!$result){
    echo "Fail to execute: " . $sql . $conn->error . "<br />";
}else{
    $session_id = $result->fetch_assoc();
    
    echo "<pre>";
        var_dump($session_id);
        echo "</pre>";
    /*
    $sql = "SELECT * FROM cart WHERE session_id = '{$session_id}' AND purchased = 1";
    $cart_result = $conn->query($sql);
    if(!$cart_result){
        echo "Fail to execute: " . $sql . $conn->error . "<br />";
    }else{
        
        while($cart_rows = $cart_result->fetch_assoc()){
            echo "<pre>";
        var_dump($cart_rows);
        echo "</pre>";
        /*
            foreach($cart_rows as $key => $value){
                echo $key . " " . $value . "<br />";
            }
            
        }
        
        
        
    }
    */
}


echo "<br />";
echo '<a href="/">Return to homepage</a>';
?>