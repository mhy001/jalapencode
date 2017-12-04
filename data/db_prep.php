<?php

require_once('config.php');

$dbname = "jalapeno";

$result = $conn->select_db($dbname);

if($result == true) {
    $conn->query("DROP DATABASE {$dbname}");
}

$result = $conn->query("CREATE DATABASE {$dbname}");
if($result == false){
    echo "Fail to create database" . PHP_EOL;
}

$conn->select_db($dbname);
if ($conn->error) {
  die("Cannot select database " . $conn->error. PHP_EOL);
}

$sql = "
CREATE TABLE INVENTORY (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  cat_id INT(10) UNSIGNED NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) UNSIGNED NOT NULL,
  quantity INT(10) UNSIGNED NOT NULL,
  heat_id INT(10) UNSIGNED NOT NULL,
  image VARCHAR(255) NULL,
  review LONGTEXT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE RECIPE (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  product_id INT(10) UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  url VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (product_id)
    REFERENCES INVENTORY(id)
    ON DELETE CASCADE
);

CREATE TABLE ACCOUNT (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  fname VARCHAR(30) NOT NULL,
  lname VARCHAR(30) NOT NULL,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  addr VARCHAR(255) NOT NULL,
  addr_2 VARCHAR(255) NOT NULL,
  addr_city VARCHAR(255) NOT NULL,
  addr_state VARCHAR(2) NOT NULL,
  addr_zipcode VARCHAR(5) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE SESSION (
  id VARCHAR(255),
  account_id INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(id),
  purchased BIT DEFAULT 0,
  purchase_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  cost FLOAT(10,2) DEFAULT 0,
  FOREIGN KEY(account_id)
    REFERENCES ACCOUNT(id)
);

CREATE TABLE CART (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  session_id VARCHAR(255) NOT NULL,
  inventory_id INT(10) UNSIGNED NOT NULL,
  quantity INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (session_id)
    REFERENCES SESSION(id)
    ON DELETE CASCADE,
  FOREIGN KEY (inventory_id)
    REFERENCES INVENTORY(id)
);";

if (!$conn->multi_query($sql)) {
    echo "Fail to create database" . $conn->error . PHP_EOL;
} else {
    echo "Created database!" . PHP_EOL;
    while ($conn->next_result()) {;} // flush multi_queries
    require_once("generate_data.php");
}

?>
