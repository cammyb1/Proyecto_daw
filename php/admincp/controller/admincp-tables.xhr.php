<?php
  session_start();

  if(isset($_SESSION["tables"])){
    $tables = $_SESSION["tables"];
    $exclude_tables = array("country_savepoint","guest_users");
    $result = array();
    $count = 0;
    foreach ($tables as $table_name => $table) {
      $count++;
      if(!in_array($table_name,$exclude_tables)){
        $item = array(
          "x" => 5*$count,
          "y" => sizeof($table),
          "indexLabel" => ucfirst($table_name)
        );
      }
      $result[]=$item;
    }
    echo json_encode($result);
  }
?>
