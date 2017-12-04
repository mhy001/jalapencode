<?php
/* Purpose: Update the saved items*/

  require_once("config.php");

  $sessionID = session_id();

  if (isset($_SESSION['userid'])) {
    $productID = $_POST['id'];

    $sql ="SELECT SESSION.*, CART.inventory_id, CART.quantity FROM SESSION
           JOIN CART ON SESSION.id =CART.session_id
           HAVING SESSION.purchased=0 AND SESSION.account_id={$_SESSION['userid']}
           AND CART.inventory_id={$productID} AND NOT SESSION.id='{$sessionID}'";
    $result = $conn->query($sql);
    if (!$result) {
      echo "Query fail" . $conn->error . PHP_EOL;
    }
    $row = $result->fetch_assoc();
    $oldSessionID = $row['id'];
    $numSaved = $row['quantity'];

    $sql = "DELETE FROM CART WHERE session_id='{$oldSessionID}' AND inventory_id={$productID}";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error. PHP_EOL;
    }

    $sql = "SELECT quantity FROM INVENTORY WHERE id={$productID}";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error. PHP_EOL;
    }
    $newQuantity = $row['quantity'] + $numSaved;

    $sql = "UPDATE INVENTORY SET quantity={$newQuantity} WHERE id={$productID}";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error. PHP_EOL;
    }
  }

 ?>
