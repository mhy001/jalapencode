<?php
/* Purpose: User login*/

if (isset($_SESSION['userid'])) {
  header("Location: /");
  return;
}

if (empty($_POST["username"]) || empty($_POST["password"])) {
  header("Location: register");
} else {
  require_once("config.php");

  $sessionID = session_id();
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT id FROM ACCOUNT WHERE username='{$username}' AND password='{$password}'";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  } else if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $customerID = $row["id"];


    $sql = "UPDATE SESSION SET account_id={$customerID} WHERE id='{$sessionID}'";
    $result = $conn->query($sql);
    if (!$result) {
      echo $sql . "Query failed" . $conn->error . PHP_EOL;
    }

    $_SESSION['userid'] = $customerID;
  } else {
    header("HTTP/1.1 401 Unauthorized");
    return;
  }
}

?>
