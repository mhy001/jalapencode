<?php

header('Content-type: application/json');
$data = new StdClass;
$items = array();
$item = new StdClass;

for ($x = 0; $x < 20; $x++) {
  $item->name = "Pikachu";
  $item->url = "images/pikachu.jpg";
  $item->description = "PIKA PIKA";
  $item->heatRating = 5.0;
  $item->reviewRating = 5.0;
  $item->price = 99.99;
  $items[] = $item;
}

  $data->items = $items;
  echo json_encode($data);

?>
