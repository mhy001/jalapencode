<?php
/* Purpose: Returns webpage of indiviual product */

header('Content-type: application/json');
$item = new StdClass;

$item->name = "Pikachu";
$item->imageURL = "images/pikachu.jpg";
$item->description = "PIKA PIKA";
$item->heatRating = 5.0;
$item->reviewRating = 5.0;
$item->price = 99.99;
$item->id = 0;
$item->quantity = 10;

echo json_encode($item);

?>
