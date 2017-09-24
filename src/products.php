<?php
/* Purpose: Return JSON of all products */

header('Content-type: application/json');
$items = array();

for ($x = 0; $x < 20; $x++) {
  $item = new StdClass;
  $item->name = "Pikachu";
  $item->imageURL = "images/pikachu.jpg";
  $item->description = "PIKA PIKA";
  $item->heatRating = 5.0;
  $item->reviewRating = 5.0;
  $item->price = 99.99;
  $item->id = $x;
  $item->quantity = 10;
  $items[] = $item;
}

echo json_encode($items);

?>
