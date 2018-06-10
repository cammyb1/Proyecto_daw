<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");

  $data=array(
    "data"=>array(),
    "status"=>"Failed",
    "message"=>"",
    "class"=>"alert alert-danger"
  );

  if(!empty($_POST)){
    foreach($_POST as $key=>$value){
      if($value==""){
        $data["message"].="<b>$key</b> is missing.<br>";
      }else{
        $data["data"][$key] = $value;
      }
    }

    if($data["message"]==""){
      $data["class"]="alert alert-success";
      $data["message"]="YAY!!";
      $data["status"]="Sucess";
    }
  }

  echo json_encode($data);
?>
