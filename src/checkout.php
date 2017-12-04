<?php
/* Purpose: Returns webpage of checkout */

require_once("config.php");

$sql = "SELECT SUM(CART.quantity * INVENTORY.price) as subtotal FROM CART
        INNER JOIN INVENTORY ON CART.inventory_id=INVENTORY.id
        AND CART.session_id='{$sessionID}'";
$result = $conn->query($sql);

if (!$result) {
  echo "Query fail" . $conn->error . PHP_EOL;
} else {
  $row = $result->fetch_assoc();

  $subtotal = $row["subtotal"];
  $tax = $subtotal * 0.085;
  $total = $subtotal + $tax;

  if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    $sql = "SELECT * FROM ACCOUNT WHERE id='{$userid}'";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    }
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $addr = $row['addr'];
    $addr2 = $row['addr_2'];
    $city = $row['addr_city'];
    $state = $row['addr_state'];
    $zip = $row['addr_zipcode'];
  } else {
    $fname = '';
    $lname = '';
    $email = '';
    $addr = '';
    $addr2 = '';
    $city = '';
    $state = '';
    $zip = '';
  }

  require '../public/view/checkout.phtml';
}

?>
