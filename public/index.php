<?php
    require_once("../src/config.php");
    include_once("../src/generate_dummy_data_for_db.php");

    session_start(); // TODO: use IP as id if cookies disabled
    setcookie("TestCookie", "testVaue", time()+3600);

    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

    switch ($request_uri[0]) {
      case '/': //home page
        require 'index.html';
        break;
      case '/products': // get json of product list
        require '../src/products.php';
        break;
      case '/product': // get page of individual product
        // TODO: make product page template
        require '../src/product.php';
        break;
      case '/getCart': // get json of customer's cart
        require '../src/getCart.php';
        break;
      case '/updateCart': // post update customer's cart
        require '../src/updateCart.php';
        break;
      default:
        // TODO: make pretty 404 page
        require 'views/404.html';
        break;
    }
?>
