<?php 
    require_once("config.php");
    echo "<br />";
    
    // Random string generator
    function RSG($len){
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomString = "";
        for($i = 0; $i < $len; $i++){
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $randomString;
    }
    
    // Random number generator
    function RNG($len){
        $characters = "1234567890";
        $randomString = "";
        for($i = 0; $i < $len; $i++){
            $randomString .= $characters[rand(1, strlen($characters) - 1)];
        }
        
        return $randomString;
    }


    // Fill database with 100 entries
    for($i = 0; $i < 100; $i++){
        $name = RSG(rand(5,12));
        $price = RNG(rand(1,3));
        $quantity = RNG(rand(1, 2));
        $heat_rate = RNG(1);
        $cat_id = RNG(rand(1,2));
        $image = RSG(rand(10, 50));
        $review = RSG(rand(100,500));

    
    
    $sql = "INSERT INTO `inventory` (name, price, quantity, heat_rate, cat_id, image, review) 
                            VALUES ('$name', $price, $quantity, $heat_rate, $cat_id, '$image', '$review')";
                            
        $conn->query($sql);

    }
    
    //echo "DONE";
?>