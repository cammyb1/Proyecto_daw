<?php
class Consultor{
  private $table;
  private $db;
  private $conectar;

  public function __construct($table) {
      $this->table=(string) $table;

      require_once 'Conexion.php';
      $this->conectar=new Connect();
      $this->db=$this->conectar->conectar();
  }

  public function getConetar(){
      return $this->conectar;
  }

  public function db(){
      return $this->db;
  }

  public function getUser($username,$password){
    $username = $this->db->escape_string($username);
    $password = $this->db->escape_string($password);
    $object_output = null;
    $consulta = "SELECT user_id,name,lastname,username,email,fecha,type FROM $this->table WHERE username='$username' AND password=PASSWORD($password)";

    if($this->userExist($username,$password)){
      if($resultado = $this->db->query($consulta)){
        $fila = $resultado->fetch_assoc();
        $object_output = new User($fila["user_id"],$fila["username"],$fila["lastname"],$fila["name"],$fila["email"],$fila["fecha"],$fila["type"]);

        header("location:profile.php");
      }
    }

    return $object_output;
  }

  public function userExist($username) {
      $username = $this->db->escape_string($username);
      $consulta = "SELECT * FROM $this->table WHERE username='$username'";
      if($resultado=$this->db->query($consulta)){
        if($resultado->num_rows>0){
          return true;
        }
      }

      return false;
  }

  public function getFullTable($table_name){
    $consulta = "SELECT * FROM $table_name";
    $result = array();
    $table_name = $this->db->escape_string($table_name);

    if($resultado=$this->db->query($consulta)){
      while($fila = $resultado->fetch_assoc()){
        $row = array();
        foreach($fila as $k=>$v){
          $row[$k]=$v;
        }
        $result[]= $row;
      }
    }

    return $result;
  }

  public function getThisTables($tables){
    $result_tables = array();
    $logger = new Logger();

    foreach($tables as $table){
      $result_tables[$table] = $this->getFullTable($table);
    }

    return $result_tables;
  }
}
?>
