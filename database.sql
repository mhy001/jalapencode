CREATE DATABASE `jalapeno`;

create table inventory (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  product_name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL DEFAULT 0,
  quantity INT NOT NULL,
  heat_rate INT NOT NULL,
  cat_id INT NOT NULL,
  image VARCHAR(255) NULL,
  review LONGTEXT NULL
);

create table category (
  cate_id INT NOT NULL AUTO_INCREMENT,
  category VARCHAR(20) NOT NULL,
  FOREIGN KEY (cate_id) REFERENCES inventory(car_id)
);

create table heat_rating (
  heat_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  heat VARCHAR(20) NOT NULL
);

create table account (
  acc_id INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  password VARCHAR(20) NOT NULL,
  addr_num INT(10) NOT NULL,
  addr_street VARCHAR(20) NOT NULL 
  #transaction history reference
  #cart reference
);

create table transaction_history (
  id_num INT(100) NOT NULL AUTO_INCREMENT,
  prod_name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL DEFAULT 0,
  quantity INT(300) NULL,
  heat_rate VARCHAR(20) NOT NULL, #reference to heat rating
  category_t VARCHAR(20) NOT NULL, #reference to category 
  trans_image VARCHAR(255) NULL,
  FOREIGN KEY (id_num) REFERENCES inventory(id),
  FOREIGN KEY (category_t) REFERENCES category(category)
);

create table cart (
  id_num_cart INT(100) NOT NULL PRIMARY KEY, #reference product id 
  acc_id_cart INT(100) NOT NULL PRIMARY KEY, #references account
  prod_name_cart VARCHAR(255) NOT NULL,
  price_cart DECIMAL(10,2) NOT NULL DEFAULT 0,
  quantity_cart INT(300) NULL,
  heat_rate_cart VARCHAR(20) NOT NULL,
  category_cart VARCHAR(20) NOT NULL,
  image_cart VARCHAR(255) NULL,
  sub_total DECIMAL(10,2) NOT NULL DEFAULT 0,
  total DECIMAL(10,2) NOT NULL DEFAULT,
  FOREIGN KEY (id_num_cart) REFERENCES inventory(id),
  FOREIGN KEY (acc_id_cart) REFERENCES account(acc_id)
);