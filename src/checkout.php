<?php
/* Purpose: Returns webpage of checkout */

require_once("config.php");

$sql = "SELECT SUM(CART.quantity * INVENTORY.price) as subtotal FROM CART INNER JOIN INVENTORY ON CART.inventory_id=INVENTORY.id";
$result = $conn->query($sql);

if (!$result) {
  echo "Query fail" . $conn->error . "<br />";
} else {
  $row = $result->fetch_assoc();

  $subtotal = $row["subtotal"];
  $tax = $subtotal * 0.085;
  $total = $subtotal + $tax;

  require '../public/view/checkout.phtml';
}

?>
