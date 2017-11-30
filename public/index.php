<?php
    require_once("../src/config.php");
    

   session_start();
   $sessionID = session_id();
   $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
   // Keep track of visitted site
   /*
   if(!isset($_SESSION['visited'])){
        $_SESSION['visited'] = array();
   }else{
        array_push($_SESSION['visited'], $request_uri[0]);
   }
    */   

   // If user is not logged in
   if(!isset($_SESSION['username'])){
      
        
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
        // Get the id of the currently logged in user
        
        $sql = "SELECT * FROM account WHERE username = '{$_SESSION['username']}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }else{
            $user_account = $result->fetch_assoc();  
            $_SESSION['user_id'] = $user_account['id'];
        }
        
        // Set the current session_id to the id of the user just logged in
        $sql = "INSERT INTO SESSION (id, account_id) VALUES ('{$sessionID}', {$_SESSION['user_id']})";
        //$sql = "INSERT INTO session () VALUES ()SET account_id = {$_SESSION['user_id']} WHERE id = '{$sessionID}'";
        $result = $conn->query($sql);
        if(!$result){
            echo "Fail to execute: " .  $sql . $conn->error . "<br />";
        }
        
        // Check if user just logs in has been browsing and adding items into their cart as guest or previously have 
        // any items in their cart
        // If yes, combine all the items in their cart together
        // If no, do nothing 
        $sql = "SELECT * FROM session WHERE account_id = '{$_SESSION['user_id']}'";
        $session_result = $conn->query($sql);
        if(!$session_result){
            echo "Fail to execute: " . $sql . $conn->error . "<br />";
        }else{
            while($session_table = $session_result->fetch_assoc()){
                /*
                echo "<pre>";
                var_dump($session_table);
                echo "</pre>";
                */
                if($session_table['id'] != $sessionID){
                    
                
                    // Check each id if it is the current $sessionID, if yes->do nothing, if no
                    // - Go into cart table, replace session_id with current $sessionID
                    // - Delete that row in session table
                    $sql = "SELECT * FROM cart WHERE session_id = '{$session_table['id']}'";
                    $cart_result = $conn->query($sql);
                    if(!$cart_result){
                        echo "Fail to execute: " .  $sql . $conn->error . "<br />";
                    }else{
                        while($cart_table = $cart_result->fetch_assoc()){
                            /*
                            echo "<pre>";
                            var_dump($session_table);
                            echo "</pre>";
                            */
                            $sql = "UPDATE cart SET session_id = '{$sessionID}' WHERE session_id = '{$session_table['id']}'";
                            $result = $conn->query($sql);
                            if(!$result){
                                echo "Fail to execute: " .  $sql . $conn->error . "<br />";
                            }
                            $sql = "DELETE FROM session WHERE id = '{$session_table['id']}'";
                            $result = $conn->query($sql);
                            if(!$result){
                                echo "Fail to execute: " .  $sql . $conn->error . "<br />";   
                            }   
                        }                  
                    }
                }
            }// end session_table while loop
        }
    }
    

    

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
        
      case '/account_setting':
        require 'view/account_setting.phtml';
        break;
        
      case '/update_account':
        require '../src/update_account.php';
        break;
        
      case '/transaction_history':
        require '../src/transaction_hist.php';
        break;
        
      case '/processReview':
        require '../src/processReview.php';
        break;
                
      default:
        require 'view/404.phtml';
        break;
        
        
    }
?>