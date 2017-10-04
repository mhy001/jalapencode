<?php
/* Purpose: Return JSON of all products */

header('Content-type: application/json');

require_once("../data/config.php");

$conn->select_db('jalapeno');


// RETRIEVE DATA FROM INVENTORY TABLE
$sql = "SELECT * FROM INVENTORY";

$result = $conn->query($sql);

$items = array();

if(!$result){
    echo "Query fail" .  $conn->error . "<br />";
}

while($row = $result->fetch_assoc()){
    $item = new stdClass();

    $item = (object)$row;
    
    $items[] = $item;
    

}



/*
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
  $item->category = 0;
  $items[] = $item;
}
*/
echo json_encode($items);

?>
