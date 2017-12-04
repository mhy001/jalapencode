<?php
/* Purpose: Return JSON of customer cart */

header('Content-type: application/json');
require_once("config.php");

$sessionID = session_id();
$sql = "SELECT CART.quantity as cart_count, INVENTORY.* FROM CART
        INNER JOIN INVENTORY ON CART.inventory_id=INVENTORY.id
        AND CART.session_id='{$sessionID}'";
$result = $conn->query($sql);
$cart = array();

if (!$result) {
  echo $sql . "Query failed" . $conn->error . PHP_EOL;
} else {
  while ($row = $result->fetch_assoc()) {
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

    $cartItem = new stdClass;
    $cartItem->count = $row["cart_count"];
    $cartItem->product = $item;
    $cart[] =  $cartItem;
  }

  echo json_encode($cart);
}

?>
