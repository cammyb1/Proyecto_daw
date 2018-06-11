<?php
  include "model/landing.model.php";
  session_start();

  $_GET["table_name"]="landing_config";

  $data_recived = include_once("../MainComponents/controller/ProcessUserConfig.controller.php");

  if(sizeof($data_recived)>0){
    $_SESSION["landing_config"]=$data_recived;
  }

  include "view/landing.view.php";
?>
