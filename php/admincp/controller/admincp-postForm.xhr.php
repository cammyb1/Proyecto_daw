<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  include "../../MainComponents/modelo/common.xhr.php";

  $file_temp= "";
  $file_path = $_SERVER['DOCUMENT_ROOT']."/Proyecto_daw/resources/images/";//FIXME: ACUERDATE DE CAMBIARLO GIL!
  $file_with_path="";
  $consultor = new Consultor();
  $had_file = false;
  $existing_file_colnames = array("tumbnail","bg_landing");
  $canDelete = false;
  $using_file_col = "";

  $data=array(
    "data"=>array(),
    "status"=>"Failed",
    "message"=>"",
    "class"=>"alert alert-danger"
  );

  if(!empty($_POST)){
    foreach($_POST as $key=>$value){
      if($value==""){
        $data["message"].="<li><b>$key</b> is missing.</li>";
      }else{
        $data["data"][$key] = $value;
      }
    }

    foreach($_FILES as $key=>$value){
      if($value==""){
        $data["message"].="<li><b>$key</b> is missing.</li>";
      }else{
        $had_file=true;
        $file_name = $value["name"];
        $file_size = $value["size"];
        $file_error = $value["error"];
        $file_temp = $value["tmp_name"];

        $ext_allowed = array("jpg","jpeg","png");
        $file_ext = explode(".",$file_name);
        $file_actual_ext = end($file_ext);
        $isAllowed = in_array($file_actual_ext,$ext_allowed);

        if($isAllowed){
          if($file_error==0){
            if($file_size<2000000){

              if(in_array($key,$existing_file_colnames)){
                $canDelete=true;
                $using_file_col=$key;
              }

              $file_without_path = time().".".strtolower($file_actual_ext);
              $file_with_path = $file_path.$file_without_path;
              $data["data"][$key]=$file_without_path;
            }else{
              $data["message"].="<li><b>File</b> is too BIG.</li>";
            }
          }else{
            $data["message"].="<li><b>File</b> upload error.</li>";
          }
        }
      }
    }


    $table_name = $data["data"]["table_name"];
    $type = $data["data"]["type"];

    unset($data["data"]["table_name"]);
    unset($data["data"]["type"]);

    $columns = array_keys($data["data"]);
    $sets = array_values($data["data"]);
    $query = false;
    if(isset($table_name)&&isset($columns)&&isset($sets)){
      if($type=="insert"){
        if($table_name=="users"){
          $token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890%!<>*";
          $token = str_shuffle($token);
          $token = substr($token,0,10);
          $columns[] = "token";
          $sets[] = $token;
          $email = $data["data"]["Email"];

          $mail = new PHPMailer();
          $id = $consultor-> insertID("users");

          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = 'ssl';
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 465;
          $mail->IsHTML(true);
          $mail->Username = "emailproyectojonathan@gmail.com";
          $mail->Password = "proyectoprueba123";
          $mail->SetFrom("emailproyectojonathan@gmail.com");
          $mail->Subject = "Create your password";
          $mail->AddAddress($email,$data["data"]["Name"]);
          $_GET["title"]="Welcome!";
          $_GET["desc"]= "We sent you and invitation to join us";
          $_GET["redir"]="http://localhost/Proyecto_daw/php/admincp/index.php?user=".$id."&token=".$token;
          $mail->Body= include_once("../view/email.view.php");//FIXME: CAMBIAR RUTA DE CORREO!

          $query = $consultor->insertElement($table_name,$columns,$sets);
          if($query){
            if(!$mail->send()){
              $data["message"].="<li>Mail send Failed</li>";
            }
          }
        }else if($table_name=="comments"){
          $dir = "C:/xampp/htdocs/Proyecto_daw/resources/avatars"; //FIXME: CAMBIA ESTO GIL!
          $avatars = scandir($dir);
          unset($avatars[0]);
          unset($avatars[1]);

          $total_avatars = sizeof($avatars);
          $rand = rand(2,$total_avatars);

          $pick_random_avatar = $avatars[$rand];

          $columns[] = "avatar";
          $sets[] = $pick_random_avatar;
          $query = $consultor->insertElement($table_name,$columns,$sets);
        }else{
          $query = $consultor->insertElement($table_name,$columns,$sets);
        }
      }else if($type=="update"){
        $realsets = array();
        $id = $data["data"]["elem_id"];

        unset($data["data"]["elem_id"]);

        foreach($data["data"] as $key=>$value){
          if($key=="password"){
            $encrypted_pass = base64_encode($value);
            $realsets[] = "$key='$encrypted_pass'";
          }else{
            $realsets[] = $key."='".$value."'";
          }
        }

        if($had_file){
          if($canDelete){
            $last_file = $consultor -> getTableComplex($table_name,[$using_file_col],["id=$id"]);
            if(strlen($last_file[0][$using_file_col])>0){
              $delete_route = $file_path.$last_file[0][$using_file_col];

              if(file_exists($delete_route)){
                unlink($delete_route);
              }
            }
          }
        }

        $query = $consultor->updateElement($table_name,$realsets,["id=$id"]);
      }

      if($query){
        if(!file_exists($file_with_path)){
          move_uploaded_file($file_temp,$file_with_path);
        }
      }else{
        $data["message"].="<li>Failed <b>$table_name</b> upload error.</li>";
      }
    }


    if($data["message"]==""){
      $data["class"]="alert alert-success";
      $data["message"]="Your request was handle successfuly";
      $data["status"]="Sucess";
    }
  }

  echo json_encode($data);
?>
