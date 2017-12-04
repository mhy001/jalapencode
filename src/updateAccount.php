<?php
/* Purpose: Update user account*/
if (!isset($_SESSION['userid'])) {
  header("Location: /");
  return;
}
require_once("config.php");

$userid = $_SESSION['userid'];
$fname = $_POST["firstName"];
$lname = $_POST["lastName"];
$email = $_POST["email"];
$addr = $_POST["address"];
$addr2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];

$sql = "UPDATE ACCOUNT SET fname='{$fname}', lname='{$lname}', email='{$email}',
        addr='{$addr}', addr_2='{$addr2}', addr_city='{$city}', addr_state='{$state}',
        addr_zipcode='{$zip}' WHERE id='{$userid}'";

$result = $conn->query($sql);
if (!$result) {
  echo $sql . "Query failed" . $conn->error . PHP_EOL;
}

?>
