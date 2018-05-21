<?php
  include "model/admincp-profile.model.php";

  $log = new Logger();
  $t_names = array("users","articles","comments","imagenes");
  $consultor = new Consultor($t_names[1]);

  if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
    $log->console("LLEGUE!");
  }else{
    $_SESSION["tables"] = $consultor->getThisTables($t_names);
  }

  include "view/admincp-profile.view.php";
?>
