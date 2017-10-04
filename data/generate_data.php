<?php 

echo "<br /> IN GENERATE DATA FILE <br />";

$stmt = $conn->prepare("INSERT INTO INVENTORY (cat_id, product_name, description, price, quantity, heat_id, image, review) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ? );");
if(!$stmt){
    echo "Fail to prepare statement" .  $conn->error . " " . $conn->errno . "<br />";
}

$stmt->bind_param("issdiiss", $cat_id, $product_name, $description, $price, $quantity, $heat_id, $image, $review);

##########
# ITEM 1 #
##########
$cat_id = 1;
$product_name = "Jalepeno";
$description = $conn->real_escape_string("The jalapeno or jalapeno is a medium to large size chili pepper which is prized for the warm, burning sensation when eaten. Ripe, the jalapeno can be 2 to 3.5 inches long and is commonly sold when still green. It is a cultivar of the species Capsicum annuum. It is named after the town of Xalapa, Veracruz, where it was traditionally produced. 160 square kilometres are dedicated for the cultivation of jalapeno in Mexico alone; primarily in the Papaloapan river basin in the north of the state of Veracruz and in the Delicias, Chihuahua area. The jalapeno is known by different names throughout Mexico. Jalapenos are also known as cuaresmenos, huachinangos and chiles gordos. The jalapeno rates between 2,500 and 10,000 Scoville units in heat.");
$price = 1.00;
$quantity = 25;
$heat_id = 2;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 2 #
##########

##########
# ITEM 3 #
##########

##########
# ITEM 4 #
##########

##########
# ITEM 5 #
##########

##########
# ITEM 6 #
##########

##########
# ITEM 7 #
##########

##########
# ITEM 8 #
##########

##########
# ITEM 9 #
##########

$stmt->close();



?>