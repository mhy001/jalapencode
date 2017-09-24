<?php
/* Purpose: Return JSON of client's cart */

header('Content-type: application/json');
$items = array();

for ($x = 0; $x < 5; $x++) {
  $item = new StdClass;
  $item->id = $x;
  $item->quantity = 11 - $x;
  $items[] = $item;
}

echo json_encode($items);

 ?>
