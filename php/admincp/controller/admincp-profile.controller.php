<?php
  include "model/admincp-profile.model.php";
  include "model/admincp-dashboard.model.php";

  $t_names = array("users","articles","comments","topics","article_likes","tags");
  $consultor_articles = new Consultor($t_names[1]);
  $logger = new Logger();

  if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
  }else{
    $_SESSION["tables"] = $consultor_articles->getThisTables($t_names);
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
    $file_error = $file["error"];
    $file_temp = $file["tmp_name"];
    $ext_allowed = array("jpg","jpeg","png");
    $file_ext = explode(".",$file_name);
    $file_actual_ext = end($file_ext);
    $isAllowed = in_array($file_actual_ext,$ext_allowed);
    $file_path = "C:/xampp/htdocs/Proyecto_daw/resources/tumbnails/";//FIXME: ACUERDATE DE CAMBIARLO GIL!

    $logger->console($isAllowed);

    if($isAllowed){
      if($file_error==0){
        if($file_size<1000000){
          $file_without_path = time().".".strtolower($file_actual_ext);
          $file_with_path = $file_path.$file_without_path;
          $current_article_id = $consultor_articles->getTableSize("articles")+1;
          $inserted_article = $consultor_articles->insertElement(["article_id","title","topic","body","tags","date","user_id","tumbnail"],[$current_article_id,$a_title,$a_topic,$a_body,$a_tags,"NOW()",$_SESSION["usuario"]->getId(),$file_without_path]);
          if($inserted_article){
            move_uploaded_file($file_temp,$file_with_path);
          }
        }else{
          $logger->console("[FORM-VALIDATION]: FILE $file_name TOO BIG!");
        }
      }else{
        $logger->console("[FORM-VALIDATION]: FILE $file_name ERROR!");
      }
    }
  }

  include "view/admincp-profile.view.php";
?>
