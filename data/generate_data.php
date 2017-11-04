<?php

$stmt_account = $conn->prepare("INSERT INTO ACCOUNT (fname, lname, username, password, email, addr, addr_2, addr_city, addr_state, addr_zipcode)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,?);");
$stmt_inventory = $conn->prepare("INSERT INTO INVENTORY (cat_id, product_name, description, price, quantity, heat_id, image, review)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ? );");
$stmt_recipe = $conn->prepare("INSERT INTO RECIPE (product_id, name, image, url)
                      VALUES (?, ?, ?, ?);");

if(!$stmt_account || !$stmt_inventory || !$stmt_recipe){
  exit("Fail to prepare statements" .  $conn->error . " " . $conn->errno . PHP_EOL);
}

$stmt_account->bind_param("ssssssssss", $fname, $lname, $username, $password, $email, $addr, $addr_2, $addr_city, $addr_state, $addr_zipcode);
$stmt_inventory->bind_param("issdiiss", $cat_id, $product_name, $description, $price, $quantity, $heat_id, $image, $review);
$stmt_recipe->bind_param("isss", $product_id, $recipe_name, $recipe_image, $recipe_url);

#################
# GUEST ACCOUNT #
#################
$fname = "";
$lname = "";
$username = "guest";
$password = "";
$email = "";
$addr = "";
$addr_2 = "";
$addr_city = "";
$addr_state = "";
$addr_zipcode = "";
if(!$stmt_account->execute()) {
    echo "Failed to execute" .  $stmt_account->error . " " . $stmt_account->errno . PHP_EOL;
}

##########
# ITEM 1 #
##########
$cat_id = 1;
$product_name = "Jalapeno";
$description = $conn->real_escape_string("The jalapeno or jalapeno is a medium to large size chili pepper which is prized for the warm, burning sensation when eaten. Ripe, the jalapeno can be 2 to 3.5 inches long and is commonly sold when still green. It is a cultivar of the species Capsicum annuum. It is named after the town of Xalapa, Veracruz, where it was traditionally produced. 160 square kilometres are dedicated for the cultivation of jalapeno in Mexico alone; primarily in the Papaloapan river basin in the north of the state of Veracruz and in the Delicias, Chihuahua area. The jalapeno is known by different names throughout Mexico. Jalapenos are also known as cuaresmenos, huachinangos and chiles gordos. The jalapeno rates between 2,500 and 10,000 Scoville units in heat.");
$price = 1.00;
$quantity = 25;
$heat_id = 2;
$image = "images/jalapeno.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

$product_id = 1;
$recipe_names = ["Jalapeno Hummus", "Japalpeno Popper Chicken", "Stuffed Jalapeno"];
$recipe_images = ["images/recipe/jalapenoHummus.jpg", "images/recipe/jalapenoPopperChicken.jpg", "images/recipe/jalapenoStuffed.jpg"];
$recipe_urls = ["http://allrecipes.com/recipe/46462/jalapeno-hummus/", "http://allrecipes.com/recipe/65671/jalapeno-popper-chicken/", "http://allrecipes.com/recipe/26975/stuffed-jalapenos-iii/"];
for ($i = 0; $i < 3; $i++) {
  $recipe_name = $recipe_names[$i];
  $recipe_image = $recipe_images[$i];
  $recipe_url = $recipe_urls[$i];
  if(!$stmt_recipe->execute()) {
    echo "Failed to execute" .  $stmt_recipe->error . " " . $stmt_recipe->errno . PHP_EOL;
  }
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
$image = "images/chipotle.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

$product_id = 2;
$recipe_names = ["Chipotle Hummus", "Chipotle Mayo", "Chipotle Shrimp Taco"];
$recipe_images = ["images/recipe/chipotleHummus.jpg", "images/recipe/chipotleMayo.jpg", "images/recipe/chipotleShrimpTaco.jpg"];
$recipe_urls = ["http://allrecipes.com/recipe/254230/chipotle-hummus/", "http://allrecipes.com/recipe/87542/chipotle-mayo/", "http://allrecipes.com/recipe/109777/chipotle-shrimp-tacos/"];
for ($i = 0; $i < 3; $i++) {
  $recipe_name = $recipe_names[$i];
  $recipe_image = $recipe_images[$i];
  $recipe_url = $recipe_urls[$i];
  if(!$stmt_recipe->execute()) {
    echo "Failed to execute" .  $stmt_recipe->error . " " . $stmt_recipe->errno . PHP_EOL;
  }
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
$image = "images/serrano.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
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
$image = "images/tabasco.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

##########
# ITEM 5 #
##########
$cat_id = 1;
$product_name = "Cayenne";
$description = $conn->real_escape_string("The Cayenne is a red, hot chili pepper used to flavor dishes, and for medicinal purposes. Named for the city of Cayenne in French Guiana, it is a cultivar of Capsicum annuum related to bell peppers, jalapenos, and others. The capsicum genus is in the nightshade family. The fruits are generally dried and ground, or pulped and baked into cakes, which are then ground and sifted to make the powder, Cayenne pepper. Cayenne is used in cooking spicy hot dishes, as a powder or in its whole form or in a thin, vinegar based sauce. It is generally rated at 30,000 to 50,000 Scoville Units. It is also used as a herbal supplement, and was mentioned by Nicholas Culpeper in his Complete Herbal. ");
$price = 2.00;
$quantity = 25;
$heat_id = 3;
$image = "images/cayenne.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

##########
# ITEM 6 #
##########
$cat_id = 1;
$product_name = "Thai Pepper";
$description = $conn->real_escape_string("Thai pepper in Thai refers to any of three cultivars of chili pepper, found commonly in Thailand, and also in neighbouring countries, such as Malaysia, Indonesia, the Philippines and Singapore. It is also found in India, mainly Kerala, and is used in traditional dishes of kerala cuisine. These tiny little fiery chilis point downward from the plant and their colors change directly from green to red. This type of chili can be found in Malaysia, Brunei, Indonesia, and the Philippines but most commonly in Thailand. Although small in size compared to other types of chili, the chili padi is relatively strong at 50,000 to 100,000 on the Scoville pungency scale. Malaysia consumes about 140 million worth of chilies each year.");
$price = 1.00;
$quantity = 25;
$heat_id = 4;
$image = "images/thai.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

##########
# ITEM 7 #
##########
$cat_id = 1;
$product_name = "Datil";
$description = $conn->real_escape_string("The Datil is an exceptionally hot pepper, a variety of the species Capsicum chinense. Datils are similar to habaneros but have a sweeter, fruitier flavor. Their level of spiciness may be anywhere from 100,000 to 300,000 scoville units. Datil peppers are cultivated throughout the United States and elsewhere, but the majority are produced in St. Augustine, Florida, where they have been traditionally cultivated for roughly two hundred thirty years.");
$price = 3.00;
$quantity = 25;
$heat_id = 4;
$image = "images/datil.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

##########
# ITEM 8 #
##########
$cat_id = 1;
$product_name = "Fatalii";
$description = $conn->real_escape_string("The Fatalii is a chili pepper of Capsicum chinense that originates in central and southern Africa. It is described to have a fruity, citrus flavor with a searing heat that is comparable to the standard habanero. The Scoville Food Institute lists the Fatalii as the sixth hottest pepper with Scoville units ranging from 125,000 to 325,000 units. The plants grow 20 to 25 inches in height, and plant distance should be about the same. The pendant pods get 2.5 to 3.5 inches long and about 0.75 to 1.5 inches wide. From a pale green, they mature to a bright yellow. The Fatalii is known for its extreme heat and citrus flavor. Because of such flavor and heat it makes for a unique hot sauce that usually compromises of other citrus flavors like lime and lemon. The walls of the peppers are very thin which makes it very easy to dry. After drying they can be used as powders.");
$price = 3.00;
$quantity = 25;
$heat_id = 4;
$image = "images/fatalii.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

##########
# ITEM 9 #
##########
$cat_id = 1;
$product_name = "Carolina Reaper";
$description = $conn->real_escape_string("The Carolina Reaper is a hybrid chili pepper of the Capsicum chinense species, originally called the HP22B, bred by cultivator Ed Currie, who runs PuckerButt Pepper Company in Fort Mill, South Carolina. The Carolina Reaper was rated as the worlds hottest chili pepper by Guinness World Records according to 2012 tests, averaging 1,569,300 SHU on the Scoville scale with peak levels of over 2,200,000 SHU. The previous record holder was the Trinidad Moruga Scorpion.");
$price = 5.00;
$quantity = 25;
$heat_id = 5;
$image = "images/carolinareaper.png";
$review = "Blank";
if(!$stmt_inventory->execute()) {
    echo "Failed to execute" .  $stmt_inventory->error . " " . $stmt_inventory->errno . PHP_EOL;
}

$stmt_inventory->close();

?>
