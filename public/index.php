<?php
    require_once("../src/config.php");
    
   
   session_start();
   
        if(!isset($_SESSION['username']) || $_SESSION['username'] != ""){
      $sessionID = session_id();

      $sql = "SELECT * FROM SESSION WHERE id='{$sessionID}'";
      $result = $conn->query($sql);
      if (!$result) {
        echo $sql . "Query failed" . $conn->error . PHP_EOL;
      } else if ($result->num_rows == 0) {
        // TODO: handle real account
        $sql = "INSERT INTO SESSION (id, account_id) VALUES ('{$sessionID}', 1)";
        $result = $conn->query($sql);
        if (!$result) {
          echo $sql . "Query failed" . $conn->error . PHP_EOL;
        }
      }
        //echo "Viewed as guest";
      }else{
        //echo "Logged in";
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
      case '/account':
        require 'view/loginSignup.phtml';
        break;
        
      case '/login':
        require '../src/login.php';
        break;
        
      case '/register':
        require '../src/register.php';
        break; 
        
      case '/logout':
        require '../src/logout.php';
        break;
        
      case '/account_setting';
        require 'view/account_setting.phtml';
        break;
        
      case '/update_account';
        require '../src/update_account.php';
        break;
        
      default:
        require 'view/404.phtml';
        break;
    }
?>
