<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");

  $worked = false;

  if(isset($_POST)){
    $consultor = new Consultor();
    $t_names = array("users","articles","comments","topics","tags","country_savepoint","guest_users");
    $table_info = explode("_",$_POST["row_id"]);
    $table_name = $table_info[0];
    $row_id = $table_info[1];
    $col_names = array_keys($_POST);
    $index_rowid = array_search("row_id",$col_names);
    $sets = array();
    unset($col_names[$index_rowid]);

    foreach ($col_names as  $value) {
      $sets[] = "$value='".strip_tags($_POST[$value])."'";
    }

    $consultor->updateElement($table_name,$sets,["id=$row_id"]);
  }
?>
