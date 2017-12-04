<?php
/* Purpose: Returns webpage of order history */

if (isset($_SESSION['userid'])) {

  require '../public/view/orders.phtml';
} else {
  header("Location: /");
}

?>
