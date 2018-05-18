<?php
  include "model/admincp-login.model.php";

  $consultor = new Consultor("users");

  if(isset($_POST["login_submit"])){
    $username = $_POST["login_user"];
    $password = $_POST["login_password"];

    $usuario = $consultor->getUser($username,$password);

    if($usuario!=null){
      $_SESSION["usuario"]=$usuario;
    }
  }

  include "view/admincp-login.view.php";
?>
