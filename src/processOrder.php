<?php
/* Purpose: Process customer cart*/

if (empty($_POST["firstName"]) || empty($_POST["lastName"]) ||
    empty($_POST["address"]) || empty($_POST["city"])
    || empty($_POST["state"]) || empty($_POST["zip"])) {
  header("Location: /");
} else {
  require_once("config.php");

  $customerID = session_id();
  $firstName = !empty($_POST["firstName"]) ? $_POST["firstName"] : 'asdf';
  $lastName = $_POST["lastName"];
  $address = $_POST["address"];
  $address2 = $_POST["address2"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];

  // TODO: process the transaction
  // fix db table
  // update transaction table, cart table

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
