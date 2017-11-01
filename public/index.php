<?php
    require_once("../src/config.php");

    session_start();
    //setcookie("TestCookie", "testVaue", time()+3600);

    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

    switch ($request_uri[0]) {
      case '/': //home page
        require '../src/home.php';
        break;
      case '/getProducts': // get json of products
        require '../src/getProducts.php';
        break;
      case '/getCart': // get json of customer cart
        require '../src/getCart.php';
        break;
      case '/postCart': // post update customer's cart
        require '../src/postCart.php';
        break;
      case '/product': // page of individual product
        require '../src/product.php';
        break;
      case '/cart': // page for cart
        require '../src/cart.php';
        break;
      case '/about': // page for about
        require 'view/about.phtml';
        break;
      case '/checkout': // page for checkout
        require '../src/checkout.php';
        break;
      case '/submitOrder': // order placed
        require '../src/processOrder.php';
        break;
      default:
        require 'view/404.phtml';
        break;
    }
?>
