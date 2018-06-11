<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");

  $worked = false;
  $data = array(
    "status"=>"failed"
  );

  if(isset($_POST)){
    $consultor = new Consultor();
    $table_info = explode("_",$_POST["row_id"]);
    $table_name = $table_info[0];
    $row_id = $table_info[1];

    if($consultor->removeElement($table_name,["id=$row_id"])){
      $data["status"]="success";
    }
  }

  echo json_encode($data);
?>
