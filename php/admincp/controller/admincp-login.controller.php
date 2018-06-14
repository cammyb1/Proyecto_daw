<?php
  include "model/admincp-login.model.php";
  session_start();

  $consultor = new Consultor("users");

  if(isset($_POST["login_submit"])){
    if(isset($_POST["login_user"])&&isset($_POST["login_password"])){
      $username = $_POST["login_user"];
      $password = $_POST["login_password"];

      $usuario = $consultor->getUser($username,$password);

      if($usuario!=null){
        $_SESSION["usuario"]=$usuario;
      }
    }
  }

  if(isset($_GET["recover"])){
    include "view/admincp-recover.view.php";
  }else if(isset($_GET["user"])&&isset($_GET["token"])){
    include "view/admincp-setPassword.view.php";
  }else{
    include "view/admincp-login.view.php";
  }
?>
