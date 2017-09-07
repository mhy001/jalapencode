create table inventory (
id TINYINT(5) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
price INT(5) UNSIGNED NOT NULL,
quantity TINYINT(3) UNSIGNED NOT NULL,
heat_rate TINYINT(1) UNSIGNED NOT NULL,
cat_id TINYINT(3) UNSIGNED NOT NULL,
image VARCHAR(255) NULL,
review LONGTEXT NULL
);