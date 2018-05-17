<?php
  include "model/admincp-login.model.php";
  include "view/admincp-login.view.php";

  $consultor = new Consultor("users");

  if(isset($_POST["login_submit"])){
    $username = $_POST["login_user"];
    $password = $_POST["login_password"];

    $consultor->getUser($username,$password);

  }
?>
