<?php
/* Purpose: User logout*/

if (isset($_SESSION['userid'])) {
  $sessionID = session_id();

  $sql = "SELECT * FROM CART WHERE session_id='{$sessionID}'";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  } else if ($result->num_rows == 0) {
    // remove the session if nothing is in the cart
    $sql = "DELETE FROM SESSION WHERE id='{$sessionID}'";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    }
  } else {
    // merge all unprocessed carts
    // get old sessions
    $sql = "SELECT * FROM SESSION WHERE purchased=0 AND account_id={$_SESSION['userid']} AND NOT id='$sessionID'";
    $result = $conn->query($sql);
    if (!$result) {
      echo "Query fail" . $conn->error . PHP_EOL;
    }
      $row = $result->fetch_assoc();
      $oldsessionID = $row['id'];
      // get old cart
      $sql = "SELECT * FROM CART WHERE session_id='{$oldsessionID}'";
      $result2 = $conn->query($sql);
      if (!$result2) {
        echo "Query fail" . $conn->error . PHP_EOL;
      }
      while ($row2 = $result2->fetch_assoc()) {
        $productID = $row2['inventory_id'];
        $oldQuantity = $row2['quantity'];
        // check current cart
        $sql = "SELECT * FROM CART WHERE session_id='{$sessionID}' AND inventory_id={$productID}";
        $result3 = $conn->query($sql);
        if (!$result3) {
          echo "Query fail" . $conn->error . PHP_EOL;
        }
        if ($result3->num_rows == 0) {
          // item not in current cart
          $sql = "INSERT INTO CART (session_id, inventory_id, quantity) VALUES ('{$sessionID}', {$productID}, {$oldQuantity})";
          $result = $conn->query($sql);
          if (!$result) {
            echo $sql . "Query failed" . $conn->error. PHP_EOL;
          }
        } else {
          // item in current cart
          $row3 = $result3->fetch_assoc();
          $newQuantity = $row3['quantity'] + $oldQuantity;
          $sql = "UPDATE CART SET quantity={$newQuantity} WHERE inventory_id={$productID} AND session_id='{$sessionID}'";
          $result4 = $conn->query($sql);
          if (!$result4) {
            echo $sql . "Query failed" . $conn->error. PHP_EOL;
          }
        }
        $sql = "DELETE FROM SESSION WHERE id='{$oldsessionID}'";
        $result4 = $conn->query($sql);
        if (!$result4) {
          echo "Query fail" . $conn->error . PHP_EOL;
        }
      }
    }

  unset($_SESSION['userid']);
  session_regenerate_id();
  header("Location: /");
} else {
  header("Location: /");
}

?>
