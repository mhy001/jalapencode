<?php
/* Purpose: Display registration page*/

if (!isset($_SESSION['userid'])) {

  require '../public/view/register.phtml';
} else {
  header("Location: /");
}

?>
