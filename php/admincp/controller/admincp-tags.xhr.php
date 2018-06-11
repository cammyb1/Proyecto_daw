<?php
  include "../model/admincp-common.xhr.php";

  $consultor = new Consultor();

  echo json_encode($consultor->getTableCol("name","tags"));
?>
