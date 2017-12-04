<?php
    require_once("../src/config.php");

    if (session_start()) {
      $sessionID = session_id();

      $sql = "SELECT * FROM SESSION WHERE id='{$sessionID}'";
      $result = $conn->query($sql);
      if (!$result) {
        echo $sql . "Query failed" . $conn->error . PHP_EOL;
      } else if ($result->num_rows == 0) {
        $sql = "INSERT INTO SESSION (id, account_id) VALUES ('{$sessionID}', 1)";
        $result = $conn->query($sql);
        if (!$result) {
          echo $sql . "Query failed" . $conn->error . PHP_EOL;
        }
      }
    }

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
      case '/getSavedCart': // get json of saved customer cart
        require '../src/getSavedCart.php';
        break;
      case '/getOrderHistory': // get json of order history
        require '../src/getOrderHistory.php';
        break;
      case '/postCart': // post update customer's cart
        require '../src/postCart.php';
        break;
      case '/postSavedItem': // post update customer's saved items
        require '../src/postSavedItem.php';
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
      case '/submitOrder': // process order
        require '../src/processOrder.php';
        break;
      case '/register': // page for user registration
        require '../src/register.php';
        break;
      case '/checkUsername': // check if a user already exists
        require '../src/checkUsername.php';
        break;
      case '/registerUser': // process user registration
        require '../src/registerUser.php';
        break;
      case '/account': // page for user account_id
        require '../src/account.php';
        break;
      case '/updateAccount': // update user account info
        require '../src/updateAccount.php';
        break;
      case '/login': // user login
        require '../src/login.php';
        break;
      case '/logout': //user logout
        require '../src/logout.php';
        break;
      case '/orders': // page for order history
        require '../src/orders.php';
        break;
      default:
        require 'view/404.phtml';
        break;
    }
?>
