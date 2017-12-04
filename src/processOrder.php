<?php
/* Purpose: Process customer cart */

if (empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["email"])
    || empty($_POST["address"]) || empty($_POST["city"]) || empty($_POST["state"])
    || empty($_POST["zip"])) {
  header("Location: /");
} else {
  require_once("config.php");
  $sessionID = session_id();
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $address2 = $_POST["address2"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];

  $sql = "SELECT SUM(CART.quantity * INVENTORY.price) as subtotal FROM CART
          INNER JOIN INVENTORY ON CART.inventory_id=INVENTORY.id
          AND CART.session_id='{$sessionID}'";
  $result = $conn->query($sql);
  if (!$result) {
    echo "Query fail" . $conn->error . PHP_EOL;
  }
  $row = $result->fetch_assoc();
  $subtotal = $row["subtotal"];
  $tax = $subtotal * 0.085;
  $total = $subtotal + $tax;

  if (isset($_SESSION['userid'])) {
    $sql = "UPDATE SESSION SET purchased=1, cost={$total} WHERE id='{$sessionID}'";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    }
  } else {
    $sql = "INSERT INTO ACCOUNT (fname, lname, username, password, email, addr, addr_2, addr_city, addr_state, addr_zipcode)
            VALUES ('{$firstName}', '{$lastName}', 'guest_{$sessionID}', '', '{$email}', '{$address}', '{$address2}', '{$city}', '{$state}', '{$zip}')";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    }

    $sql = "SELECT MAX(id) as max FROM ACCOUNT";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    } else {
      $row = $result->fetch_assoc();
      $customerID = $row["max"];

      $sql = "UPDATE SESSION SET account_id={$customerID}, purchased=1, cost={$total} WHERE id='{$sessionID}'";
      $result = $conn->query($sql);
      if (!$result) {
        echo $sql . "Query failed" . $conn->error . PHP_EOL;
      }
    }

  }

  // each cart is associated with a unique session
  // an account will be associated with multiple sessions
  $oldsessionID = $sessionID;
  session_regenerate_id();
  if (isset($_SESSION['userid'])) {
    $sessionID = session_id();
    $id = $_SESSION['userid'];

    $sql = "INSERT INTO SESSION (id, account_id) VALUES ('{$sessionID}', {$id})";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    }
  }

  require '../public/view/receipt.phtml';
}

?>
