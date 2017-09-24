<?php
    require_once("../src/config.php");
    include_once("../src/generate_dummy_data_for_db.php");

    session_start(); // TODO: use IP as id if cookies disabled
    setcookie("TestCookie", "testVaue", time()+3600);

    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

    switch ($request_uri[0]) {
      // home page
      case '/':
        require 'index.html';
        break;
      // get json of products list
      case '/products':
        require '../src/products.php';
        break;
      // get page of individual product
      case '/product':
        // TODO: make product page template
        require '../src/product.php';
        break;
      case '/getCart':
        require '../src/getCart.php';
        break;
      case '/updateCart':
        require '../src/updateCart.php';
        break;
      default:
        // TODO: make 404 page
        break;
    }
?>
