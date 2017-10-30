<?php
/* Purpose: Returns webpage of home*/

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

$searchString = "";
if (count($request_uri) == 2) {
  $searchString = $request_uri[1];
}

include '../public/view/home.phtml';

?>
