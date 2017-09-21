<?php

header('Content-type: application/json');
$data = new StdClass;
$items = array();
$item = new StdClass;

for ($x = 0; $x < 20; $x++) {
  $item->name = "Pikachu";
  $item->url = "https://i.pinimg.com/736x/76/47/9d/76479dd91dc55c2768ddccfc30a4fbf5--pikachu-halloween-costume-diy-halloween-costumes.jpg";
  $item->description = "PIKA PIKA";
  $item->heatRating = 5.0;
  $item->reviewRating = 5.0;
  $item->price = 99.99;
  $items[] = $item;
}

  $data->items = $items;
  echo json_encode($data);
?>
