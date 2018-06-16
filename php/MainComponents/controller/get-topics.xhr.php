<?php
  include "../modelo/common.xhr.php";

  $consultor = new Consultor();

  echo json_encode($consultor->getTableCol("topic","topics"));
?>
