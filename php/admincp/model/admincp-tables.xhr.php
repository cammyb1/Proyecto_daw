<?php
  session_start();

  if(isset($_SESSION["tables"])){
    $tables = $_SESSION["tables"];
    $result = array();
    $count = 0;
    foreach ($tables as $table_name => $table) {
      if($table_name!="article_likes"){
        $count++;
        $item = array(
          "x" => 5*$count,
          "y" => sizeof($table),
          "indexLabel" => ucfirst($table_name)
        );
        $result[]=$item;
      }
    }
    echo json_encode($result);
  }
?>
