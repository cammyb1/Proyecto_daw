<?php
  include "model/admincp-login.model.php";
  include "view/admincp-login.view.php";

  $consultor = new Consultor("users");

  if(isset($_POST["login_submit"])){
    if(isset($_POST["login_user"])&&isset($_POST["login_password"])){
      $username = $_POST["login_user"];
      $password = $_POST["login_password"];

      $usuario = $consultor->getUser($username,$password);

      if($usuario!=null){
        $_SESSION["usuario"]=$usuario;
      }
    }else{
      $consultor->console_log("No hay usuario ni contraseña!");
    }
  }
?>
