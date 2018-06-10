<?php
  session_start();
  
  if($_SESSION["tables"]){
    $guest_users = $_SESSION["tables"]["guest_users"];
    echo sizeof($guest_users);
  }
?>
