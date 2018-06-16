<?php
  include "model/admincp-login.model.php";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require_once("../MainComponents/modelo/Components/Exception.php");
  require_once("../MainComponents/modelo/Components/OAuth.php");
  require_once("../MainComponents/modelo/Components/POP3.php");
  require_once("../MainComponents/modelo/Components/SMTP.php");
  require_once("../MainComponents/modelo/Components/PHPMailer.php");
  session_start();

  $consultor = new Consultor();
  $logger= new Logger();

  if(isset($_GET["recover"])){
    include "view/admincp-recover.view.php";
  }else if(isset($_GET["user"])&&isset($_GET["token"])){
    include "view/admincp-setPassword.view.php";
  }else{
    include "view/admincp-login.view.php";
  }

  if(isset($_POST["login_submit"])){
    if(isset($_POST["user"])&&isset($_POST["password"])){
      $username = $_POST["user"];
      $password = $_POST["password"];

      $usuario = $consultor->getUser($username,$password);

      if($usuario!=null){
        $_SESSION["usuario"]=$usuario;
      }else{
        unset($_SESSION["usuario"]);
      }
    }
  }

  if(isset($_POST["recover_submit"])){
    if(isset($_POST["email"])){
      $email = $_POST["email"];
      $exist = $consultor -> getTableComplex("users",["name","password"],["email='$email'"]);

      if(isset($exist[0])&&sizeof($exist[0])>0){
        $user = $exist[0];
        $name = $user["name"];
        $password=$user["password"];
        $decryp_password = base64_decode($password);

        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "emailproyectojonathan@gmail.com";
        $mail->Password = "proyectoprueba123";
        $mail->SetFrom("emailproyectojonathan@gmail.com");
        $mail->Subject = "Password recovery System";
        $mail->AddAddress($email,$name);
        $_GET["title"] = "Here is your password <b>$name</b>";
        $_GET["desc"] = "Be aware of peepers <i class='far fa-eye'></i> <br> Your password is $decryp_password";
        $_GET["redir"]="https://incablogp.000webhostapp.com/php/admincp/index.php";//FIXME: CAMBIAR RUTA DE CORREO!

        $mail->Body = include_once("view/email.view.php");

        $mail->send();
      }
    }
  }

  if(isset($_POST["set_submit"])){
    $logger = new Logger();
    if(isset($_GET["user"])&&isset($_GET["token"])){
      $id = $_GET["user"];
      $token = $_GET["token"];
      $_SESSION["message"]="";
      if(!empty($id)&&!empty($token)){
        $password = $_POST["password"];
        $encoded_pass=base64_encode($password);

        $couldUpdate = $consultor->updateElement("users",["password='$encoded_pass'","active=1"],["id=$id","token='$token'","active=0"]);
      }else{
        $_SESSION["message"]="";
        header("Location:index.php");
      }
    }
  }
?>
