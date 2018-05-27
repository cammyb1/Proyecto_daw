<?php
  include "model/admincp-profile.model.php";

  $log = new Logger();
  $t_names = array("users","articles","comments");
  $consultor = new Consultor($t_names[1]);

  if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
    $log->console("LLEGUE!");
  }else{
    $_SESSION["tables"] = $consultor->getThisTables($t_names);
  }

  $consultor->getTableComplex("users",["username","id","password"],["id=15","username='cammyb'"],"username",null);

  include "view/admincp-profile.view.php";
?>
