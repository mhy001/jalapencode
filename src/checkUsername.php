<?php
/* Purpose: Check for existing user */

if (empty($_POST["username"])) {
  header("Location: register");
} else {
  require_once("config.php");

  $sessionID = session_id();
  $username = $_POST["username"];

  // Check if username already exists
  $sql = "SELECT * FROM ACCOUNT WHERE username='{$username}'";
  $result = $conn->query($sql);
  if (!$result) {
    echo $sql . "Query failed" . $conn->error . PHP_EOL;
  } else if ($result->num_rows > 0) {
    header("HTTP/1.1 401 Unauthorized");
    return;
  }
}

?>
