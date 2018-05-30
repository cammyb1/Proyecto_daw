<?php
  include "model/admincp-profile.model.php";
  include "model/admincp-editor.model.php";

  $t_names = array("users","articles","comments","topics","article_likes","tags","tumbnails");
  $consultor = new Consultor($t_names[1]);

  if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
  }else{
    $_SESSION["tables"] = $consultor->getThisTables($t_names);
  }

  include "view/admincp-profile.view.php";
?>
