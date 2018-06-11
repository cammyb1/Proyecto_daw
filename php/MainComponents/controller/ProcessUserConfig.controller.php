<?php
  include "../modelo/Consultor.php";
  include "../modelo/Components/User.php";
  include "../modelo/Components/Logger.php";

  if(!isset($_SESSION)){
    session_start();
  }

  $data=array(
    "data"=>array(),
    "status"=>"",
  );

  if(isset($_GET["table_name"])){
    $consultor = new Consultor();
    $table_name = $_GET["table_name"];

    $result = $consultor->getItemsBy($table_name,"user_id",$_SESSION["usuario"]->getId());

    if(sizeof($result)==0){
      $data["status"]="failed";
    }

    if($data["message"]==""){

      unset($data["user_id"]);
      unset($data["id"]);

      $data=array(
        "data"=>$result,
        "status"=>"Success",
        "message"=>"Your request succeeded!",
        "class"=>"alert alert-danger"
      );
    }
  }else{
    $data["message"]="Something failed..";
  }

  echo json_encode($data);
?>
