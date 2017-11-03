<?php
/* Purpose: Process customer cart*/

if (empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["email"]) ||
    empty($_POST["address"]) || empty($_POST["city"])
    || empty($_POST["state"]) || empty($_POST["zip"])) {
  header("Location: /");
} else {
  require_once("config.php");

  $customerID = rand(); // used as username
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $address2 = $_POST["address2"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];

  // TODO: process the transaction
  // fix db table
  // update transaction table, cart table

  if($_SESSION['is_logged_in'] == false){
    
    // Create a guest account
    $sql = "INSERT INTO account (cart_id, fname, lname, username, password, email, addr, addr_2, addr_city, addr_state, addr_zipcode, trans_hist_id)
                    VALUES (2, '{$firstName}', '{$lastName}', '{$customerID}', 'random', '{$email}', '{$address}', '{$address2}', '{$city}', '{$state}', '{$zip}', null);";
    if(!$conn->query($sql)){
        echo "FAIL: " . $sql . $conn->error .  $conn->error . "<br />";
    }
    
    // Get the id of the guest account
    $sql = "SELECT id FROM account WHERE username = '{$customerID}';";
    $result = $conn->query($sql);
    if(!$result){
        echo "FAIL: " . $sql . $conn->error . $conn->errno . "<br />";
    }
    $acc_id = $result->fetch_assoc();
    
    
    // Get item(s) in cart
    $sql = "SELECT * FROM cart;";
    $cart_result = $conn->query($sql);
    if(!$cart_result){
        echo "FAIL: " . $sql . $conn->error .  $conn->error . "<br />";
    }
    while($rows = $cart_result->fetch_assoc()){
            // Get item price
            $sql = "SELECT price FROM inventory WHERE id = '{$rows['inventory_id']}'";
            $result = $conn->query($sql);
                if(!$result){
                    echo "FAIL: " . $sql . $conn->error . $conn->errno . "<br />";
                }
                $price = $result->fetch_row();
                var_dump($price);
            // Insert into the transaction_history table 
            for($i = 0; $i < $rows['quantity']; $i++){
                
                $item_id = $rows['inventory_id'];
                $sql = "INSERT INTO transaction_history (acc_id, inventory_id, date_purchased, price)
                    VALUES ({$acc_id['id']}, {$item_id}, NOW(), {$price[0]});";
                $result = $conn->query($sql);
                if(!$result){
                    echo "FAIL: " . $sql . $conn->error . $conn->errno . "<br />";
                }
                
                
            }
        
    }
    // Populate the transaction table
    
     
  }
  require '../public/view/receipt.phtml';
}
/*
$sql = "";
$result = $conn->query($sql);

if (!$result) {
  echo "Query fail" .  $conn->error . "<br />";
} else {
  $row = $result->fetch_assoc();

  $item = new stdClass;
  $item->id = $row["id"];
  $item->product_name = $row["product_name"];
  $item->image = $row["image"];
  $item->description = $row["description"];
  $item->heat_id = $row["heat_id"];
  $item->review = $row["review"];
  $item->price = $row["price"];
  $item->quantity = $row["quantity"];
  $item->cat_id = $row["cat_id"];

  require '../public/view/receipt.phtml';
}
*/

?>
