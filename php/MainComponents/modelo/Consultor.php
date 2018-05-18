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
    $consulta = "SELECT user_id,name,lastname,username,email,fecha,type FROM $this->table WHERE username=$username AND password=PASSWORD($password)";

    if($this->userExist($username,$password)){
      if($resultado = $this->db->query($consulta)){
        $fila = $resultado->fetch_assoc();
        $object_output = new User($fila["user_id"],$fila["username"],$fila["name"],$fila["email"],$fila["fecha"],$fila["type"]);
        $this->console_log($resultado);
      }
    }

    return $object_output;
  }

  public function userExist($username) {
      $username = $this->db->escape_string($username);
      $consulta = "SELECT * FROM $this->table WHERE username=$username LIMIT 1";

      if($resultado=$this->db->query($consulta)){
        if($resultado->num_rows>0){
          return true;
        }
      }

      return false;
  }

  function console_log( $data ) {
    $output = $data;
    if ( is_array( $output )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
  }

}
?>
