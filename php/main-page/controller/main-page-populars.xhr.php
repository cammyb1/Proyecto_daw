<?php

  include "../model/main-page-articles.model.php";
  session_start();

  $returnData = array(
    "data"=>array(),
  );

  $consultor = new Consultor();

  $populars = $consultor -> getLimitedTable("articles",0,5,"likes",["likes>=0"]);

  if($populars){
    foreach($populars as $popular){
      $returnData["data"][] = array(
        "tumbnail"=>$popular["tumbnail"],
        "title"=>$popular["title"],
        "likes"=>$popular["likes"],
        "id"=>$popular["id"]
      );
    }
  }

  echo json_encode($returnData);
?>
