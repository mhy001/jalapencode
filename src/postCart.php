<?php
/* Purpose: Update the client's cart */

  require_once("config.php");

  $customerID = session_id();
  $productID = $_POST["id"];
  $quantity = $_POST["quantity"];

  $sql = "SELECT quantity FROM INVENTORY WHERE id={$productID}";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error;
  } else if ($result->num_rows == 0) {
    echo $productID . " is not a valid item";
  } else { // Item in INVENTORY
    $row = $result->fetch_assoc();
    $newQuantity = $row["quantity"] - $quantity;

    if ($newQuantity < 0) {
      echo "Not enough " . $productID . " in stock";
    } else { // Enough items to add to cart
      $sql = "UPDATE INVENTORY SET quantity={$newQuantity} WHERE id={$productID}";
      $result = $conn->query($sql);
      if (!$result) {
        echo $sql . "Query failed" . $conn->error;
      } else {
        $sql = "SELECT quantity FROM CART WHERE inventory_id={$productID}";
        $result = $conn->query($sql);
        if (!$result) {
          echo $sql . "Query failed" . $conn->error;
        } else {
          if ($result->num_rows == 0) {
            // Item not found in CART
            $sql = "INSERT INTO CART (inventory_id, quantity) VALUES ({$productID}, {$quantity})";
            $result = $conn->query($sql);
            if (!$result) {
              echo $sql . "Query failed" . $conn->error;
            }
          } else {
            // Item found in CART
            $row = $result->fetch_assoc();
            $newQuantity = $row["quantity"] + $quantity;

            if ($newQuantity > 0) {
              $sql = "UPDATE CART SET quantity={$newQuantity} WHERE inventory_id={$productID}";
            } else {
              $sql = "DELETE FROM CART WHERE inventory_id={$productID}";
            }
            $result = $conn->query($sql);
            if (!$result) {
              echo $sql . "Query failed" . $conn->error;
            }
          }
        }
      }
    }
  }

 ?>
