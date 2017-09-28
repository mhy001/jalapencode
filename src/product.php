<?php
/* Purpose: Returns webpage of indiviual product */

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

$item = new StdClass;

$item->name = "Pikachu";
$item->imageURL = "images/pikachu.jpg";
$item->description = "PIKA PIKA";
$item->heatRating = 5.0;
$item->reviewRating = 5.0;
$item->price = 99.99;
$item->id = $request_uri[1];
$item->quantity = 10;

require '../public/view/product.phtml';

?>
