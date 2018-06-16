<?php
  include "../../MainComponents/modelo/common.xhr.php";
  session_start();

  $t_names = array("users","articles","comments","topics","tags","country_savepoint","guest_users","mail_box");
  $consultor = new Consultor();

  $_SESSION["tables"] = $consultor->getThisTables($t_names);
?>
