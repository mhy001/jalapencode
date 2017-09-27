CREATE DATABASE `jalapeno`;

CREATE TABLE INVENTORY (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  product_name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL DEFAULT 0,
  quantity INT NOT NULL,
  heat_id INT NOT NULL,
  cat_id INT NOT NULL,
  image VARCHAR(255) NULL,
  review LONGTEXT NULL
);

CREATE TABLE ACCOUNT (
  acc_id INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  password VARCHAR(20) NOT NULL,
  addr_street VARCHAR(50) NOT NULL,
  addr_city VARCHAR(50) NOT NULL,
  addr_state VARCHAR(20) NOT NULL,
  addr_zip INT(10) NOT NULL
);

CREATE TABLE TRANSACTION_HISTORY (
  id_num_t INT(100) NOT NULL AUTO_INCREMENT,
  prod_name_t VARCHAR(255) NOT NULL,
  price_t DECIMAL(10,2) NOT NULL DEFAULT 0,
  heat_rate_t INT NOT NULL, #reference to heat rating
  category_t INT NOT NULL, #reference to category 
  image_t VARCHAR(255) NULL,
  FOREIGN KEY (id_num) REFERENCES INVENTORY(id),
  FOREIGN KEY (prod_name_t) REFERENCES INVENTORY(product_name),
  FOREIGN KEY (price_t) REFERENCES INVENTORY(price),
  FOREIGN KEY (image_t) REFERENCES INVENTORY(image),
  FOREIGN KEY (heat_rate_t) REFERENCES INVENTORY(heat_id),
  FOREIGN KEY (category_t) REFERENCES INVENTORY(cat_id)
);

CREATE TABLE CART (
  cart_id INT(100) NOT NULL
  id_num_cart INT(100) NOT NULL, #reference product id 
  acc_id_cart INT(100) NOT NULL, #references account
  prod_name_cart VARCHAR(255) NOT NULL,
  price_cart DECIMAL(10,2) NOT NULL DEFAULT 0,
  quantity_cart INT(300) NULL,
  heat_rate_cart INT NOT NULL,
  category_cart INT NOT NULL,
  image_cart VARCHAR(255) NULL,
  sub_total DECIMAL(10,2) DEFAULT 0,
  total DECIMAL(10,2) DEFAULT 0,
  FOREIGN KEY (id_num_cart) REFERENCES INVENTORY(id),
  FOREIGN KEY (acc_id_cart) REFERENCES ACCOUNT(acc_id),
  FOREIGN KEY (prod_name_cart) REFERENCES INVENTORY(product_name),
  FOREIGN KEY (price_cart) REFERENCES INVENTORY(price),
  FOREIGN KEY (quantity_cart) REFERENCES INVENTORY(quantity),
  FOREIGN KEY (heat_rate_cart) REFERENCES INVENTORY(heat_id),
  FOREIGN KEY (category_cart) REFERENCES INVENTORY(cat_id),
  FOREIGN KEY (image_cart) REFERENCES INVENTORY(image),
  FOREIGN KEY (cart_id) REFERENCES ACCOUNT(acc_id)
);

INSERT INTO INVENTORY VALUES (1000, 'Jalepeno', 'The jalapeño or jalapeno is a medium to large size chili pepper which is prized for the warm, burning sensation when eaten. Ripe, the jalapeño can be 2–3½ inches long and is commonly sold when still green. It is a cultivar of the species Capsicum annuum. It is named after the town of Xalapa, Veracruz, where it was traditionally produced. 160 square kilometres are dedicated for the cultivation of jalapeño in Mexico alone; primarily in the Papaloapan river basin in the north of the state of Veracruz and in the Delicias, Chihuahua area. The jalapeño is known by different names throughout Mexico. Jalapeños are also known as cuaresmeños, huachinangos and chiles gordos. The jalapeño rates between 2,500 and 10,000 Scoville units in heat. ', 1.00, 25, 2, 1, 'Something.com', 'Blank review');
INSERT INTO INVENTORY VALUES (1001, 'Chipotle', 'A chipotle is a smoke-dried jalapeño chili used primarily in Mexican, Mexican-American, Tex-Mex, and Mexican-inspired cuisine. There are many varieties of jalapeños which vary in size and heat. In Mexico, the jalapeño is also known as the cuaresmeño and gordo. Until recently, chipotles were almost exclusively found in the markets of central and southern Mexico. As Mexican food became more popular in the United States in the late 20th century, jalapeño production and processing began to move into Northern Mexico and the United States. Scoville Heat Units: 10,000-50,000.', 1.00, 25, 3, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1002, 'Serrano', 'A serrano pepper is a type of chili pepper that originated in the mountainous regions of the Mexican states of Puebla and Hidalgo. Unripe serranos are green, but the color at maturity varies. Common colors are red, brown, orange, or yellow. Serranos are very meaty and thus they do not dry very well. They are generally between 1 and 4 inches long and around ½ inch wide. Most serranos rate between 10,000 and 20,000 Scoville units.', 1.00, 25, 3, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1003, 'Tabasco', 'The Tabasco pepper is a variety of chile pepper species Capsicum frutescens. Like all frutescens chilis, the tabasco plant has a typical bushy growth, which commercial cultivation makes stronger by trimming the plants. The tapered fruits, around 4 cm long, are initially pale yellowish-green and turn yellow and orange before ripening to bright red. Tabascos rate from 30,000 to 50,000 on the Scoville scale of heat levels. A large part of the tabasco pepper stock fell victim to the tobacco mosaic virus in the 1960s, and the first resistant variety was not able to be cultured until around 1970. The sauces featured in this category contain the specific pepper variety called tabasco among other pepper varieties and ingredients. ', 1.00, 25, 3, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1004, 'Cayenne', 'The Cayenne is a red, hot chili pepper used to flavor dishes, and for medicinal purposes. Named for the city of Cayenne in French Guiana, it is a cultivar of Capsicum annuum related to bell peppers, jalapeños, and others. The capsicum genus is in the nightshade family. The fruits are generally dried and ground, or pulped and baked into cakes, which are then ground and sifted to make the powder, Cayenne pepper. Cayenne is used in cooking spicy hot dishes, as a powder or in its whole form or in a thin, vinegar-based sauce. It is generally rated at 30,000 to 50,000 Scoville Units. It is also used as a herbal supplement, and was mentioned by Nicholas Culpeper in his Complete Herbal. ', 1.00, 25, 3, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1005, 'Thai Pepper' , 'Thai pepper in Thai refers to any of three cultivars of chili pepper, found commonly in Thailand, and also in neighbouring countries, such as Malaysia, Indonesia, the Philippines and Singapore. It is also found in India, mainly Kerala, and is used in traditional dishes of kerala cuisine. These tiny little fiery chilis point downward from the plant and their colors change directly from green to red. This type of chili can be found in Malaysia, Brunei, Indonesia, and the Philippines but most commonly in Thailand. Although small in size compared to other types of chili, the chili padi is relatively strong at 50,000 to 100,000 on the Scoville pungency scale. Malaysia consumes about 140 million worth of chilies each year. ', 1.00, 25, 4, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1006, 'Datil', 'The Datil is an exceptionally hot pepper, a variety of the species Capsicum chinense. Datils are similar to habaneros but have a sweeter, fruitier flavor. Their level of spiciness may be anywhere from 100,000 to 300,000 scoville units. Datil peppers are cultivated throughout the United States and elsewhere, but the majority are produced in St. Augustine, Florida, where they have been traditionally cultivated for roughly two-hundred thirty years.', 1.00, 25, 4, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1007, 'Fatilli', 'The Fatalii is a chili pepper of Capsicum chinense that originates in central and southern Africa. It is described to have a fruity, citrus flavor with a searing heat that is comparable to the standard habanero. The Scoville Food Institute lists the Fatalii as the sixth hottest pepper with Scoville units ranging from 125,000 ~ 325,000 units. The plants grow 20 to 25 inches in height, and plant distance should be about the same. The pendant pods get 2.5 to 3.5 inches long and about 0.75 to 1.5 inches wide. From a pale green, they mature to a bright yellow. The Fatalii is known for its extreme heat and citrus flavor. Because of such flavor and heat it makes for a unique hot sauce that usually compromises of other citrus flavors like lime and lemon. The walls of the peppers are very thin which makes it very easy to dry. After drying they can be used as powders.', 1.00, 25, 4, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1008, 'Bell Pepper', 'The bell pepper is a cultivar group of the species Capsicum annuum. Cultivars of the plant produce fruits in different colors, including red, yellow, orange, green, chocolate/brown, vanilla/white, and purple. Bell peppers are sometimes grouped with less pungent pepper varieties as sweet peppers. The whitish ribs and seeds inside bell peppers may be consumed, but some people find the taste to be bitter.', 1.00, 25, 1, 1, 'Something.com', 'Blank Review');
INSERT INTO INVENTORY VALUES (1009, 'Carolina Reaper', 'The Carolina Reaper is a hybrid chili pepper of the Capsicum chinense species, originally called the HP22B, bred by cultivator Ed Currie, who runs PuckerButt Pepper Company in Fort Mill, South Carolina. The Carolina Reaper was rated as the worlds hottest chili pepper by Guinness World Records according to 2012 tests, averaging 1,569,300 SHU on the Scoville scale with peak levels of over 2,200,000 SHU. The previous record-holder was the Trinidad Moruga Scorpion.', 1.00, 25, 5, 1, 'Something.com', 'Blank Review');
                              
INSERT INTO ACCOUNT VALUES (101, 'Jeffrey', 'Liv', 'password123', '123 Address Street', 'Fullerton', 'CA', 92831);
