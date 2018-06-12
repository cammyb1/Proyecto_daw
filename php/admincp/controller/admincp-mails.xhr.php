<?php
  include "../model/admincp-common.xhr.php";
  session_start();

  $consultor = new Consultor();
  $result = array(
    "data"=>array(),
    "status"=>"Failed",
    "message"=>"",
    "class"=>"alert alert-danger"
  );

  if(isset($_SESSION["usuario"])){

    $tabla = $consultor -> getTableComplex("mail_box",["*"],null,"watched");

    if(sizeof($tabla)>0){
      foreach($tabla as $key=>$value){
        $result["data"][$key]=$value;
      }
    }

    if($result["message"]==""){
      $result["status"]="Success";
      $result["message"]="Enhorabuena!";
      $result["class"]="alert alert-success";
    }
  }else{
    $result["message"]="Something went wrong";
  }

  echo json_encode($result);
?>
