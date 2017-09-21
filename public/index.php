<?php
    require_once("../src/config.php");
    include_once("../src/generate_dummy_data_for_db.php");

    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

    switch ($request_uri[0]) {
      // home page
      case '/':
        readfile("index.html");
        break;
      // get products list
      case '/products':
        require '../src/products.php';
        break;
      // everything else
      default:
        // TODO: make 404 page
        break;
    }
?>
