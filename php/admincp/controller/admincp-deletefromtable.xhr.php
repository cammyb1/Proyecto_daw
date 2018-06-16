<?php
  include "../../MainComponents/modelo/common.xhr.php";

  $worked = false;
  $data = array(
    "status"=>"failed"
  );

  if(isset($_POST)){
    $consultor = new Consultor();
    $table_info = explode("-",$_POST["row_id"]);
    $table_name = $table_info[0];
    $row_id = $table_info[1];
    $hasFile = false;
    $fileRoute = $_SERVER['DOCUMENT_ROOT']."/resources/images/";//FIXME: ACUERDATE DE CAMBIARLO GIL!
    $existing_file_colnames = array("tumbnail","bg_landing");

    $beforeRemoveValue = $consultor->getTableComplex($table_name,["*"],["id=$row_id"]);
    $beforeKeys = array_keys($beforeRemoveValue[0]);

    foreach($beforeRemoveValue[0] as $key=>$value){
      if(in_array($key,$existing_file_colnames)){
        $hasFile=true;
        $fileRoute = $fileRoute.$beforeRemoveValue[0][$key];
      }
    }

    if($hasFile&&file_exists($fileRoute)){
      unlink($fileRoute);
    }



    if($consultor->removeElement($table_name,["id=$row_id"])){
      $data["status"]="success";
    }
  }

  echo json_encode($data);
?>
