<?php
  session_start();

  if(isset($_SESSION["modified_article"])){
    $edit_value = $_SESSION["edit"];
    $tabla_articulo = $_SESSION["tables"]["articles"];
    $current_article = array();


    foreach ($tabla_articulo as $key => $value) {
      if($tabla_articulo[$key]["id"]==$edit_value){
        $current_article = $tabla_articulo[$key];
      }
    }

    if(isset($current_article["body"])){
      echo $current_article["body"];
    }

    unset($_SESSION["edit"]);
    unset($_SESSION["modified_article"]);
  }
?>
