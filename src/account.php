<?php
/* Purpose: Display a user's account*/

if (isset($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];

  $sql = "SELECT * FROM ACCOUNT WHERE id='{$userid}'";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  }
  $row = $result->fetch_assoc();
  $fname = $row['fname'];
  $lname = $row['lname'];
  $email = $row['email'];
  $addr = $row['addr'];
  $addr2 = $row['addr_2'];
  $city = $row['addr_city'];
  $state = $row['addr_state'];
  $zip = $row['addr_zipcode'];

  require '../public/view/account.phtml';
} else {
  header("Location: /");
}

?>
