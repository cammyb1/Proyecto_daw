<?php
  include "../model/main-page-articles.model.php";
  session_start();

  $result = array(
    "status"=>"failed",
    "already"=>false
  );

  $consultor = new Consultor();

  if(isset($_POST["article_id"])){
    $article_id = $_POST["article_id"];
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $worked = false;

    if($consultor->elemetExist("article_voted","guest_ip",$user_ip)){
      $result["already"]=true;
    }else{
      $inserted = $consultor->insertElement("article_voted",["article_id","guest_ip"],[$article_id,$user_ip]);
      if($inserted){
        $worked = $consultor-> updateElement("articles",["likes=likes+1"],["id=$article_id"]);
      }
    }

    if($worked){
      $result["status"]="success";
    }
  }

  echo json_encode($result);
?>
