<?php

  include "../model/main-page-articles.model.php";
  session_start();

  $returnData = array(
    "data"=>array(),
  );

  $consultor = new Consultor();

  $populars = $consultor -> getTableComplex("articles",["*"],["likes>=0"],"likes");

  if($populars){
    foreach($populars as $popular){
      $returnData["data"][$popular["id"]] = array(
        "tumbnail"=>$popular["tumbnail"],
        "title"=>$popular["title"],
        "likes"=>$popular["likes"]
      );
    }
  }

  echo json_encode($returnData);
?>
