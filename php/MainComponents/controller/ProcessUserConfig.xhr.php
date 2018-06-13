<?php
  require_once("../modelo/Components/Logger.php");
  require_once("../modelo/Components/User.php");
  require_once("../modelo/Consultor.php");

  $data=array(
    "data"=>array(),
    "status"=>"",
  );

  if(isset($_POST["table_name"])){
    $consultor = new Consultor();
    $table_name = $_POST["table_name"];

    $result = $consultor->getFullTable($table_name);

    if(sizeof($result)==0){
      $data["status"]="failed";
    }

    if($data["status"]==""){

      unset($result["id"]);

      $data=array(
        "data"=>$result,
        "status"=>"Success",
        "message"=>"Your request succeeded!",
        "class"=>"alert alertsuccess"
      );
    }
  }else{
    $data["message"]="Something failed..";
  }

  echo json_encode($data);
?>
