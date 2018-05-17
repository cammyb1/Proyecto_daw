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
    $consulta = "SELECT user_id,name,lastname,username,email,fecha,type FROM $this->table WHERE username=$username AND password=PASSWORD($password)";

    if($resultado = $this->db->query($consulta)){
      $_SESSION["mensaje"]=$resultado->num_rows;
    }

  }

}
?>
