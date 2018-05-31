<?php
  include "model/admincp-profile.model.php";
  include "model/admincp-dashboard.model.php";

  $t_names = array("users","articles","comments","topics","article_likes","tags","tumbnails");
  $consultor = new Consultor($t_names[1]);

  if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
  }else{
    $_SESSION["tables"] = $consultor->getThisTables($t_names);
  }

  if(isset($_POST["Enviar"])){
    $a_title = $_POST["a_title"];
    $a_topic = $_POST["a_topic"];
    $a_tags = $_POST["a_tags"];
    $a_body = $_POST["body"];

    //VALIDAR Y SUBIR IMAGEN ANTES DE INSERTAR ARTICULO
    $file = $_FILES["article_tumb"];
    $file_name = $file["name"];
    $file_size = $file["size"];

    $consultor->insertElement(["article_id","title","topic","body","tags","date","user_id","tumbnail"],["null",$a_title,$a_topic,$a_body,$a_tags,"now()",$_SESSION["usuario"]->getId(),$file_name]);
  }

  include "view/admincp-profile.view.php";
?>
