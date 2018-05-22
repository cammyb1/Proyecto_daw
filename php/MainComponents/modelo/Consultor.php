<?php
class Consultor{
  private $table;
  private $db;
  private $conectar;
  private $logger;

  public function __construct($table) {
      $this->table=(string) $table;

      require_once 'Conexion.php';
      $this->conectar=new Connect();
      $this->db=$this->conectar->conectar();
      $this->logger = new Logger();
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
    }else{
      $logger->console("[BD-ERR] $table_name no existe en la base de datos.");
    }

    return $result;
  }

  public function insertElement($columns,$sets){
    if(is_array($columns)&&is_array($sets)){
      for ($i=0;$i<size_of($columns);$i++) {
        $columns[$i]=$this->db->escape_string($columns[$i]);
      }
      for ($i=0;$i<size_of($sets);$i++) {
        $sets[$i]=$this->db->escape_string($columns[$i]);
      }

      $columns = implode(",",$columns)
      $sets = implode(",",$sets);

      $consulta = "INSERT INTO ".$this->table."($columns) VALUES ($sets);"

      if($resultado = $this->db->query($consulta)){
        $logger->console("[DB-LOG] Elemento ingresado correctamente");
      }else{
        $logger->console("[DB-LOG] No se pudo ingresar el elemento");
      }
    }else{
      $logger->console("[COND-ERR] Comprueba los parametros de 'insertElement'");
    }
  }

  public function removeElement($conditions,$operator=" AND "){
    if(is_array($conditions)){
      $condition = implode($operator,$conditions);
      $consulta = "DELETE FROM $this->table WHERE $condition";

      if($resulto = $this->db->query($consulta)){
        if($this->db->affected_rows > 0){
          $logger->console("[DB-LOG] Hubo un total de ".$this->db->affected_rows." filas afectadas.");
        }else{
          $logger->console("[DB-LOG] No hubo filas afectadas");
        }
      }
    }else{
      $logger->console("[COND-ERR] Comprueba los parametros de 'removeElement'");
    }
  }

  public function updateElement($sets,$conditions,$operator=" AND "){
    if(is_array($conditions)&&is_array($sets)){

      $conditions = implode($operator,$conditions)
      $sets = implode(",",$sets);

      $consulta = "UPDATE ".$this->table." SET $sets WHERE $conditions;"

      if($resultado = $this->db->query($consulta)){
        $logger->console("[DB-LOG] Elemento actualizado correctamente");
      }else{
        $logger->console("[DB-LOG] No se pudo ingresar el elemento");
      }
    }else{
      $logger->console("[COND-ERR] Comprueba los parametros de 'insertElement'");
    }
  }

  public function getThisTables($tables){
    $result_tables = array();

    foreach($tables as $table){
      $result_tables[$table] = $this->getFullTable($table);
    }

    return $result_tables;
  }


}
?>
