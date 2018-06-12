<?php
  include "../model/admincp-common.xhr.php";

  $data=array(
    "data"=>array(),
    "status"=>"Failed",
    "message"=>"",
    "class"=>"alert alert-danger"
  );
  $file_temp= "";
  $file_with_path="";
  $consultor = new Consultor();

  if(!empty($_POST)){
    foreach($_POST as $key=>$value){
      if($value==""){
        $data["message"].="<li><b>$key</b> is missing.</li>";
      }else{
        $data["data"][$key] = strtolower($value);
      }
    }

    foreach($_FILES as $key=>$value){
      if($value==""){
        $data["message"].="<li><b>$key</b> is missing.</li>";
      }else{
        $file_name = $value["name"];
        $file_size = $value["size"];
        $file_error = $value["error"];
        $file_temp = $value["tmp_name"];

        $ext_allowed = array("jpg","jpeg","png");
        $file_ext = explode(".",$file_name);
        $file_actual_ext = end($file_ext);
        $isAllowed = in_array($file_actual_ext,$ext_allowed);
        $file_path = "C:/xampp/htdocs/Proyecto_daw/resources/tumbnails/";//FIXME: ACUERDATE DE CAMBIARLO GIL!

        if($isAllowed){
          if($file_error==0){
            if($file_size<1000000){
              $file_without_path = time().".".strtolower($file_actual_ext);
              $file_with_path = $file_path.$file_without_path;
              $data["data"][$key]=$file_with_path;
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
        $query = $consultor->insertElement($table_name,$columns,$sets);
      }else if($type=="update"){
        $realsets = array();
        $id = $data["data"]["elem_id"];

        unset($data["data"]["elem_id"]);

        foreach($data["data"] as $key=>$value){
          $realsets[] = $key."='".$value."'";
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
      $data["message"]="YAY!!";
      $data["status"]="Sucess";
    }
  }

  echo json_encode($data);
?>
