<?php
    require_once("config.php");

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
         $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus eleifend mauris. Fusce blandit nisi non felis efficitur, a semper enim luctus. Proin sapien lacus, interdum vel ex id, lobortis iaculis tellus. Morbi venenatis, nibh nec eleifend feugiat, leo dolor dictum nibh, vel placerat metus justo at mi. Suspendisse iaculis interdum lectus, id interdum quam mollis ut. Fusce aliquam ipsum quis efficitur blandit. Maecenas magna neque, condimentum et ullamcorper a, hendrerit ut quam. Nullam varius interdum mi. Aliquam ullamcorper quis lacus quis suscipit. Mauris mollis ipsum convallis, bibendum tortor vitae, consectetur leo. Aliquam accumsan dolor ut nisl posuere hendrerit. ";
        $name = RSG(rand(5,12));
        $price = RNG(rand(1,3));
        $quantity = RNG(rand(1, 2));
        $heat_rate = RNG(1);
        $cat_id = RNG(rand(1,2));
        $image = RSG(rand(10, 50));
        $review = RSG(rand(100,500));


    $sql = "INSERT INTO `inventory` (name, description, price, quantity, heat_rate, cat_id, image, review)
                            VALUES ('$name', '$description', $price, $quantity, $heat_rate, $cat_id, '$image', '$review')";

        $conn->query($sql);

    }

    //echo "DONE";
?>
