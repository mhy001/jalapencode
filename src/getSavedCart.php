<?php
/* Purpose: Returns JSON save cart */

header('Content-type: application/json');
require_once("config.php");

$history = array();

if (isset($_SESSION['userid'])) {
  $sessionID = session_id();

  $sql = "SELECT * FROM SESSION
          WHERE purchased=0 AND account_id={$_SESSION['userid']} AND NOT id='$sessionID'";
  $result = $conn->query($sql);
  if (!$result) {
    echo "Query fail" . $conn->error . PHP_EOL;
  }
  while ($row = $result->fetch_assoc()) {
    $order = new stdClass;
    $order->items = array();

    $sql = "SELECT CART.session_id, CART.quantity as cart_count, INVENTORY.* FROM CART
            JOIN INVENTORY ON CART.inventory_id=INVENTORY.id
            HAVING CART.session_id='{$row['id']}'";
    $result2 = $conn->query($sql);
    if (!$result2) {
      echo "Query fail" . $conn->error . PHP_EOL;
    }
    while ($row2 = $result2->fetch_assoc()) {
      $item = new stdClass;
      $item->id = $row2["id"];
      $item->product_name = $row2["product_name"];
      $item->image = $row2["image"];
      $item->description = $row2["description"];
      $item->heat_id = $row2["heat_id"];
      $item->review = $row2["review"];
      $item->price = $row2["price"];
      $item->quantity = $row2["quantity"];
      $item->cat_id = $row2["cat_id"];

      $cartItem = new stdClass;
      $cartItem->quantity = $row2['cart_count'];
      $cartItem->product = $item;
      $order->items[] = $cartItem;
    }

    $history[] = $order;
  }
}

echo json_encode($history);

?>
