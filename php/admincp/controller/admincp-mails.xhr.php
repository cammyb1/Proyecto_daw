<?php
  include "../../MainComponents/modelo/common.xhr.php";
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
      $result["message"]="Your request was handle successfuly!";
      $result["class"]="alert alert-success";
    }
  }else{
    $result["message"]="Your request failed!";
  }

  echo json_encode($result);
?>
