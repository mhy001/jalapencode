<?php
/* Purpose: Return JSON of customer cart */

header('Content-type: application/json');
$cart = array();

for ($x = 0; $x < 5; $x++) {
  $item = new StdClass;
  $item->id = $x;
  $item->name = "Pikachu";
  $item->imageURL = "images/pikachu.jpg";
  $item->description = "PIKA PIKA";
  $item->heatRating = 5.0;
  $item->reviewRating = 5.0;
  $item->price = 99.99;
  $item->quantity = 10;
  $item->category = 0;

  $cartItem = new StdClass;
  $cartItem->count = 11 - $x;
  $cartItem->product = $item;
  $cart[] = $cartItem;
}

echo json_encode($cart);

 ?>
