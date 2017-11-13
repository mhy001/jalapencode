<?php
/* Purpose: Update the client's cart */

  require_once("config.php");

  $sessionID = session_id();
  $productID = $_POST["id"];
  $quantity = $_POST["quantity"];

  $sql = "SELECT quantity FROM INVENTORY WHERE id={$productID}";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error. PHP_EOL;
  } else if ($result->num_rows == 0) {
    echo $productID . " is not a valid item" . PHP_EOL;
  } else { // Item in INVENTORY
    $row = $result->fetch_assoc();
    $newQuantity = $row["quantity"] - $quantity;

    if ($newQuantity < 0) {
      echo "Not enough " . $productID . " in stock". PHP_EOL;
    } else { // Enough items to add to cart
      $sql = "UPDATE INVENTORY SET quantity={$newQuantity} WHERE id={$productID}";
      $result = $conn->query($sql);
      if (!$result) {
        echo $sql . "Query failed" . $conn->error. PHP_EOL;
      } else {
        $sql = "SELECT quantity FROM CART WHERE inventory_id={$productID} AND session_id='{$sessionID}'";
        $result = $conn->query($sql);
        if (!$result) {
          echo $sql . "Query failed" . $conn->error. PHP_EOL;
        } else {
          if ($result->num_rows == 0) {
            // Item not found in CART
            $sql = "INSERT INTO CART (session_id, inventory_id, quantity) VALUES ('{$sessionID}', {$productID}, {$quantity})";
            $result = $conn->query($sql);
            if (!$result) {
              echo $sql . "Query failed" . $conn->error. PHP_EOL;
            }
          } else {
            // Item found in CART
            $row = $result->fetch_assoc();
            $newQuantity = $row["quantity"] + $quantity;

            if ($newQuantity > 0) {
              $sql = "UPDATE CART SET quantity={$newQuantity} WHERE inventory_id={$productID} AND session_id='{$sessionID}'";
            } else {
              $sql = "DELETE FROM CART WHERE inventory_id={$productID} AND session_id='{$sessionID}'";
            }
            $result = $conn->query($sql);
            if (!$result) {
              echo $sql . "Query failed" . $conn->error. PHP_EOL;
            }
          }
        }
      }
    }
  }

 ?>
