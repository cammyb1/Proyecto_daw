<?php
  include "model/admincp-profile.model.php";

  $log = new Logger();
  $dashboard_tables = array("users","articles","comments","imagenes");
  $consultor = new Consultor($dashboard_tables[1]);

  if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
    $log->console("LLEGUE!");
  }else{
    $_SESSION["dashboard"] = $consultor->getThisTables($dashboard_tables);
  }

  include "view/admincp-profile.view.php";
?>
