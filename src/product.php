<?php
/* Purpose: Returns webpage of indiviual product */

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

if (count($request_uri) <= 1 || strlen($request_uri[1]) <= 0) {
  header("Location: /");
} else {
  require_once("config.php");

  $sql = "SELECT * FROM INVENTORY WHERE id={$request_uri[1]}";
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

    require '../public/view/product.phtml';
  }
}

?>
