<?php
  include "../model/admincp-common.xhr.php";

  $worked = false;
  $data = array(
    "status"=>"failed"
  );

  if(isset($_POST)){
    $consultor = new Consultor();
    $table_info = explode("-",$_POST["row_id"]);
    $table_name = $table_info[0];
    $row_id = $table_info[1];

    if($consultor->removeElement($table_name,["id=$row_id"])){
      $data["status"]="success";
    }
  }

  echo json_encode($data);
?>
