<?php
/* Purpose: Return JSON of all products */

header('Content-type: application/json');
require_once("config.php");

// RETRIEVE DATA FROM INVENTORY TABLE
$sql = "SELECT * FROM INVENTORY";
$result = $conn->query($sql);
$items = array();

if (!$result) {
    echo "Query fail" .  $conn->error . "<br />";
} else {
  while ($row = $result->fetch_assoc()){
      $item = new stdClass();
      $item = (object)$row;
      $items[] = $item;
  }

  echo json_encode($items);
}

?>
