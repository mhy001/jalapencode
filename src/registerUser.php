<?php
/* Purpose: Register a new user */

if (isset($_SESSION['userid'])) {
  header("Location: /");
  return;
}

if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
  header("Location: register");
} else {
  require_once("config.php");

  $sessionID = session_id();
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "INSERT INTO ACCOUNT (fname, lname, username, password, email, addr, addr_2, addr_city, addr_state, addr_zipcode)
          VALUES ('', '', '{$username}', '{$password}', '{$email}', '', '', '', '', '')";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  }

  $sql = "SELECT MAX(id) as max FROM ACCOUNT";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  }
  $row = $result->fetch_assoc();
  $customerID = $row["max"];

  $sql = "UPDATE SESSION SET account_id={$customerID} WHERE id='{$sessionID}'";
  $result = $conn->query($sql);

  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  }

  $_SESSION['userid'] = $customerID;
  $fname = '';
  $lname = '';
  $addr = '';
  $addr2 = '';
  $city = '';
  $state = '';
  $zip = '';
  require '../public/view/account.phtml';
}

?>
