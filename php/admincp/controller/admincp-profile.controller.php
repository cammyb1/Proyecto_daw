<?php
  include "model/admincp-profile.model.php";

  $t_names = array("users","articles","comments","topics","tags","country_savepoint","guest_users","mail_box");
  $consultor = new Consultor();
  $logger = new Logger();

  if(!isset($_SESSION["usuario"])){
    header("Location:./index.php");
  }

  $_SESSION["tables"] = $consultor->getThisTables($t_names);
  $table_headers = array();

  foreach ($_SESSION["tables"] as $table_name => $table) {
    $table_headers[$table_name] = $consultor->getTableColsNames($table_name);
  }

  $_SESSION["table_headers"]=$table_headers;

  include "view/admincp-profile.view.php";
?>
