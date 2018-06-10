<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");

  $consultor = new Consultor();

  echo json_encode($consultor->getTableCol("topic","topics"));
?>
