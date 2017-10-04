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
$cat_id = 1;
$product_name = "Chipotle";
$description = $conn->real_escape_string("A chipotle is a smoke dried jalapeno chili used primarily in Mexican, Mexican American, Tex Mex, and Mexican inspired cuisine. There are many varieties of jalapenos which vary in size and heat. In Mexico, the jalapeno is also known as the cuaresmeno and gordo. Until recently, chipotles were almost exclusively found in the markets of central and southern Mexico. As Mexican food became more popular in the United States in the late 20th century, jalapeno production and processing began to move into Northern Mexico and the United States. Scoville Heat Units 10,000 to 50,000.");
$price = 2.00;
$quantity = 25;
$heat_id = 3;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 3 #
##########
$cat_id = 1;
$product_name = "Serrano";
$description = $conn->real_escape_string("A serrano pepper is a type of chili pepper that originated in the mountainous regions of the Mexican states of Puebla and Hidalgo. Unripe serranos are green, but the color at maturity varies. Common colors are red, brown, orange, or yellow. Serranos are very meaty and thus they do not dry very well. They are generally between 1 and 4 inches long and around ½ inch wide. Most serranos rate between 10,000 and 20,000 Scoville units");
$price = 2.00;
$quantity = 25;
$heat_id = 3;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 4 #
##########
$cat_id = 1;
$product_name = "Tabasco";
$description = $conn->real_escape_string("The Tabasco pepper is a variety of chile pepper species Capsicum frutescens. Like all frutescens chilis, the tabasco plant has a typical bushy growth, which commercial cultivation makes stronger by trimming the plants. The tapered fruits, around 4 cm long, are initially pale yellowish-green and turn yellow and orange before ripening to bright red. Tabascos rate from 30,000 to 50,000 on the Scoville scale of heat levels. A large part of the tabasco pepper stock fell victim to the tobacco mosaic virus in the 1960s, and the first resistant variety was not able to be cultured until around 1970. The sauces featured in this category contain the specific pepper variety called tabasco among other pepper varieties and ingredients. ");
$price = 2.00;
$quantity= 25;
$heat_id = 3;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 5 #
##########
$cat_id = 1;
$product_name = "Cayaenne";
$description = $conn->real_escape_string("The Cayenne is a red, hot chili pepper used to flavor dishes, and for medicinal purposes. Named for the city of Cayenne in French Guiana, it is a cultivar of Capsicum annuum related to bell peppers, jalapenos, and others. The capsicum genus is in the nightshade family. The fruits are generally dried and ground, or pulped and baked into cakes, which are then ground and sifted to make the powder, Cayenne pepper. Cayenne is used in cooking spicy hot dishes, as a powder or in its whole form or in a thin, vinegar based sauce. It is generally rated at 30,000 to 50,000 Scoville Units. It is also used as a herbal supplement, and was mentioned by Nicholas Culpeper in his Complete Herbal. ");
$price = 2.00;
$quantity = 25;
$heat_id = 3;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 6 #
##########
$cat_id = 1;
$product_name = "Thai Pepper";
$description = $conn->real_escape_string("Thai pepper in Thai refers to any of three cultivars of chili pepper, found commonly in Thailand, and also in neighbouring countries, such as Malaysia, Indonesia, the Philippines and Singapore. It is also found in India, mainly Kerala, and is used in traditional dishes of kerala cuisine. These tiny little fiery chilis point downward from the plant and their colors change directly from green to red. This type of chili can be found in Malaysia, Brunei, Indonesia, and the Philippines but most commonly in Thailand. Although small in size compared to other types of chili, the chili padi is relatively strong at 50,000 to 100,000 on the Scoville pungency scale. Malaysia consumes about 140 million worth of chilies each year.");
$price = 2.00;
$quantity = 25;
$heat_id = 4;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 7 #
##########
$cat_id = 1;
$product_name = "Datil";
$description = $conn->real_escape_string("The Datil is an exceptionally hot pepper, a variety of the species Capsicum chinense. Datils are similar to habaneros but have a sweeter, fruitier flavor. Their level of spiciness may be anywhere from 100,000 to 300,000 scoville units. Datil peppers are cultivated throughout the United States and elsewhere, but the majority are produced in St. Augustine, Florida, where they have been traditionally cultivated for roughly two hundred thirty years.");
$price = 2.00;
$quantity = 25;
$heat_id = 4;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 8 #
##########
$cat_id = 1;
$product_name = "Fatilli";
$description = $conn->real_escape_string("The Fatalii is a chili pepper of Capsicum chinense that originates in central and southern Africa. It is described to have a fruity, citrus flavor with a searing heat that is comparable to the standard habanero. The Scoville Food Institute lists the Fatalii as the sixth hottest pepper with Scoville units ranging from 125,000 to 325,000 units. The plants grow 20 to 25 inches in height, and plant distance should be about the same. The pendant pods get 2.5 to 3.5 inches long and about 0.75 to 1.5 inches wide. From a pale green, they mature to a bright yellow. The Fatalii is known for its extreme heat and citrus flavor. Because of such flavor and heat it makes for a unique hot sauce that usually compromises of other citrus flavors like lime and lemon. The walls of the peppers are very thin which makes it very easy to dry. After drying they can be used as powders.");
$price = 2.00;
$quantity = 25;
$heat_id = 4;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

##########
# ITEM 9 #
##########
$cat_id = 1;
$product_name = "Carolina Reaper";
$description = $conn->real_escape_string("The Carolina Reaper is a hybrid chili pepper of the Capsicum chinense species, originally called the HP22B, bred by cultivator Ed Currie, who runs PuckerButt Pepper Company in Fort Mill, South Carolina. The Carolina Reaper was rated as the worlds hottest chili pepper by Guinness World Records according to 2012 tests, averaging 1,569,300 SHU on the Scoville scale with peak levels of over 2,200,000 SHU. The previous record holder was the Trinidad Moruga Scorpion.");
$price = 10.00;
$quantity = 25;
$heat_id = 5;
$image = "url.com";
$review = "Blank";

if(!$stmt->execute()){
    echo "Fail to execute" .  $stmt->error . " " . $stmt->errno . "<br />";
}else{
    echo "Insert successfully<br />";
}

$stmt->close();



?>
