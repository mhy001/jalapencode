<?php
/* Purpose: Return JSON of all products and customer cart */

header('Content-type: application/json');
$data = new StdClass;
$products = array();
$cart = array();

for ($x = 0; $x < 20; $x++) {
  $item = new StdClass;
  $item->id = $x;
  $item->name = "Pikachu";
  $item->imageURL = "images/pikachu.jpg";
  $item->description = "PIKA PIKA";
  $item->heatRating = 5.0;
  $item->reviewRating = 5.0;
  $item->price = 99.99;
  $item->quantity = 10;
  $products[] = $item;
}

for ($x = 0; $x < 5; $x++) {
  $item = new StdClass;
  $item->id = $x;
  $item->quantity = 11 - $x;
  $cart[] = $item;
}

$data->products = $products;
$data->cart = $cart;

echo json_encode($data);

?>
