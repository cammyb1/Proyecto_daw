<?php

Class Connect {
  private $host, $user, $pass, $database, $charset,$driver;

  public function __construct(){
    $db_config = require_once("bd.php");

    $this->host = $db_config["host"];
    $this->user = $db_config["user"];
    $this->pass = $db_config["password"];
    $this->database = $db_config["database"];
    $this->driver = $db_config["driver"];
  }

  public function conectar(){
    if($this->driver=="mysql"||$this->driver==null){
      $con = new mysqli($this->host,$this->user,$this->pass,$this->database);

      if($con->connect_errno){
        $_SESSION["mensaje"]="Error de conexion";
      }
    }

    return $con;
  }
}
?>
