<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");
  session_start();

  $consultor = new Consultor();
  $result = array(
    "data"=>array(),
    "status"=>"Failed",
    "message"=>"",
    "class"=>"alert alert-danger"
  );

  if(isset($_SESSION["usuario"])){

    $tabla = $consultor -> getFullTable("mail_box");

    if(sizeof($tabla)>0){
      foreach($tabla as $key=>$value){
        $result["data"][$key]=$value;
      }
    }else{
      $result["message"]="There is nothing to show here..";
    }

    if($result["message"]==""){
        $result["status"]="Success";
        $result["message"]="Enhorabuena!";
        $result["class"]="alert alert-success";
      );
    }
  }else{
    $result["message"]="Something went wrong";
  }


  return json_encode($result);
?>
