<?php
class Consultor{
  private $db;
  private $conectar;
  private $logger;

  public function __construct() {
      require_once('Conexion.php');
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
    $consulta = "SELECT id,name,lastname,username,email,date,type FROM users WHERE username='$username' AND password=PASSWORD($password) AND type='1'";

    if($this->elemetExist("users","username",$username)){
      $this->logger->console($consulta);
      if($resultado = $this->db->query($consulta)){
        $fila = $resultado->fetch_assoc();
        $object_output = new User($fila["id"],$fila["username"],$fila["lastname"],$fila["name"],$fila["email"],$fila["date"],$fila["type"]);

        header("location:profile.php");
      }
    }

    return $object_output;
  }

  public function getItemsBy($table,$column,$value){
    $column = $this->db->escape_string($column);
    $value = $this->db->escape_string($value);
    $table = $this->db->escape_string($table);
    $result = array();
    $consulta = "SELECT * FROM $table WHERE $column=$value";

    $this->logger->console($consulta);
    if($resultado = $this->db->query($consulta) ){
      while($fila = $resultado->fetch_assoc()){
        $result[] = $fila;
      }
    }else{
      $this->logger->console("[COND-ERR] Comprueba los parametros de 'getItemsBy'");
      $result = array();
    }

    return $result;
  }

  public function elemetExist($table_name,$column_name,$colum_value) {
      $column_name = $this->db->escape_string($column_name);
      $colum_value = $this->db->escape_string($colum_value);
      $consulta = "SELECT * FROM $table_name WHERE $column_name='$colum_value'";
      if($resultado=$this->db->query($consulta)){
        if($resultado->num_rows>0){

          //TODO: Remember to delete this for security
          $this->logger->console("[DB-RESULT] Value $colum_value exist in database.");
          return true;
        }
      }

      //TODO: this too
      $this->logger->console("[DB-ERROR] Value $colum_value does not exist in database.");
      return false;
  }

  public function getFullTable($table_name){
    $result = array();
    $table_name = $this->db->escape_string($table_name);
    $consulta = "SELECT * FROM $table_name";

    if($resultado=$this->db->query($consulta)){
      while($fila = $resultado->fetch_assoc()){
        $row = array();
        foreach($fila as $k=>$v){
          $row[$k]=$v;
        }
        $result[]= $row;
      }
    }else{
      $this->logger->console("[BD-ERR] $table_name no existe en la base de datos.");
    }

    return $result;
  }

  /*
    $table_name = "Nombre de la tabla"
    $cols = "Array de columnas a buscar"
    $conditions = "Si hay alguna condicion de busqueda"
    $orderBy = "Columna por la cual se quiere ordenar"
    $groupBy = "Columna por la cual se quiere agrupar"
  */
  public function getTableComplex($table_name,$cols,$conditions,$orderBy,$groupBy,$operator=" OR "){
    $table_name = $this->db->escape_string($table_name);
    $orderBy = isset($orderBy)?"ORDER BY ".$this->db->escape_string($orderBy):"";
    $groupBy = isset($groupBy)?"GROUP BY ".$this->db->escape_string($groupBy):"";
    $conditions = isset($conditions)?"WHERE ".implode($operator, $conditions):"";
    $cols = implode(",",$cols);
    $result = array();

    $consulta = "SELECT $cols FROM $table_name $conditions $orderBy $groupBy";

    if($resultado = $this->db->query($consulta)){
      while($row = $resultado->fetch_assoc()){
        $row_values = array();
        foreach($row as $k=>$v){
          $row_values[$k]=$v;
        }
        $result[] = $row_values;
      }
    }

    return $result;
  }

  public function getTableCol($col_name,$table_name){
    $col_name = $this->db->escape_string($col_name);
    $consulta = "SELECT $col_name FROM $table_name";
    $result = array();

    if($resultado = $this->db->query($consulta)){
      while($row = $resultado->fetch_assoc()){
        $result[] = $row[$col_name];
      }
    }

    return $result;
  }

  public function getTableSize($table_name){
    $consulta = "SELECT COUNT(*) as size FROM $table_name";

    if($resultado = $this->db->query($consulta)){
      $row = $resultado->fetch_assoc();

      return $row["size"];
    }

    return 0;
  }

  public function getLimitedTable($table_name,$limit_start,$limit_end,$col_name,$order="DESC"){
    $result = array();
    $table_name = $this->db->escape_string($table_name);
    $col_name = $this->db->escape_string($col_name);
    $consulta = "SELECT * FROM $table_name ORDER BY $col_name $order LIMIT $limit_start,$limit_end";

    if($resultado=$this->db->query($consulta)){
      while($fila = $resultado->fetch_assoc()){
        $row = array();
        foreach($fila as $k=>$v){
          $row[$k]=$v;
        }
        $result[]= $row;
      }
    }else{
      $this->logger->console("[BD-ERR] $table_name no existe en la base de datos.");
    }

    return $result;
  }

  public function insertElement($table_name,$columns,$sets){
    if(is_array($columns)&&is_array($sets)){
      for ($i=0;$i<sizeof($columns);$i++) {
        $columns[$i]=$this->db->escape_string($columns[$i]);
      }
      for ($i=0;$i<sizeof($sets);$i++) {
        if(strpos($sets[$i],"()") !== false){
          $sets[$i]=$this->db->escape_string($sets[$i]);
        }else{
          $sets[$i]="'".$this->db->escape_string($sets[$i])."'";
        }
      }

      $columns = implode(",",$columns);
      $sets = implode(",",$sets);

      $consulta = "INSERT INTO $table_name($columns) VALUES ($sets);";

      $this->logger->console($consulta);
      if($resultado = $this->db->query($consulta)){
        $this->logger->console("[DB-LOG] Elemento ingresado correctamente");
        return true;
      }else{
        $this->logger->console("[DB-LOG] No se pudo ingresar el elemento");
      }
    }else{
      $this->logger->console("[COND-ERR] Comprueba los parametros de 'insertElement'");
    }

    return false;
  }

  public function removeElement($table_name,$conditions,$operator=" AND "){
    if(is_array($conditions)){
      $condition = implode($operator,$conditions);
      $consulta = "DELETE FROM $table_name WHERE $condition";

      if($resulto = $this->db->query($consulta)){
        if($this->db->affected_rows > 0){
          $this->logger->console("[DB-LOG] Hubo un total de ".$this->db->affected_rows." filas afectadas.");
        }else{
          $this->logger->console("[DB-LOG] No hubo filas afectadas");
        }
      }
    }else{
      $this->logger->console("[COND-ERR] Comprueba los parametros de 'removeElement'");
    }
  }

  public function updateElement($table_name,$sets,$conditions,$operator=" AND "){
    if(is_array($conditions)&&is_array($sets)){

      $conditions = implode($operator,$conditions);
      $sets = implode(",",$sets);

      $consulta = "UPDATE $table_name SET $sets WHERE $conditions;";

      if($resultado = $this->db->query($consulta)){
        $this->logger->console("[DB-LOG] Elemento actualizado correctamente");
      }else{
        $this->logger->console("[DB-LOG] No se pudo ingresar el elemento");
      }
    }else{
      $this->logger->console("[COND-ERR] Comprueba los parametros de 'insertElement'");
    }
  }

  public function getThisTables($tables){
    $result_tables = array();

    foreach($tables as $table){
      $result_tables[$table] = $this->getFullTable($table);
    }

    return $result_tables;
  }

  function getOS($userAgent) {
      // Create list of operating systems with operating system name as array key
      $oses = array (
          'iPhone'            => '(iPhone)',
          'Windows 3.11'      => 'Win16',
          'Windows 95'        => '(Windows 95)|(Win95)|(Windows_95)',
          'Windows 98'        => '(Windows 98)|(Win98)',
          'Windows 2000'      => '(Windows NT 5.0)|(Windows 2000)',
          'Windows XP'        => '(Windows NT 5.1)|(Windows XP)',
          'Windows 2003'      => '(Windows NT 5.2)',
          'Windows Vista'     => '(Windows NT 6.0)|(Windows Vista)',
          'Windows 7'         => '(Windows NT 6.1)|(Windows 7)',
          'Windows NT 4.0'    => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
          'Windows ME'        => 'Windows ME',
          'Open BSD'          => 'OpenBSD',
          'Sun OS'            => 'SunOS',
          'Linux'             => '(Linux)|(X11)',
          'Safari'            => '(Safari)',
          'Mac OS'            => '(Mac_PowerPC)|(Macintosh)',
          'QNX'               => 'QNX',
          'BeOS'              => 'BeOS',
          'OS/2'              => 'OS/2',
          'Search Bot'        => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
      );

      // Loop through $oses array
      foreach($oses as $os => $preg_pattern) {
          // Use regular expressions to check operating system type
          if ( preg_match('@' . $preg_pattern . '@', $userAgent) ) {
              // Operating system was matched so return $oses key
              return $os;
          }
      }

      // Cannot find operating system so return Unknown

      return 'n/a';
  }

}
?>
