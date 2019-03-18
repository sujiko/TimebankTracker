<?php
  session_unset($_SESSION["username"]);
  $_SESSION = array();
  session_destroy();
  header("Location: index.php" );
?>
