<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");
  session_start();

  $result = array();
  if($_SESSION["tables"]){
    $tables = $_SESSION["tables"];
    foreach($tables as $table_name=>$table){
      $result[$table_name]=array("size"=>sizeof($table));
    }
  }

  echo json_encode($result);
?>
