<?php

Class Connect {
  private $host, $user, $pass, $database, $charset,$driver,$logger;

  public function __construct(){
    $db_config = require_once("BD.php");

    $this->host = $db_config["host"];
    $this->user = $db_config["user"];
    $this->pass = $db_config["password"];
    $this->database = $db_config["database"];
    $this->driver = $db_config["driver"];
    $this->logger = new Logger();
  }

  public function conectar(){
    if($this->driver=="mysql"||$this->driver==null){
      $con = new mysqli($this->host,$this->user,$this->pass);

      if($con->connect_errno){
        $this->logger->console("Error de conexion");
      }else{
        $this->generateTables($con);
      }
    }

    return $con;
  }

  public function generateTables($mysqli){
    if(!$mysqli->select_db($this->database)){
      if($mysqli->query("CREATE DATABASE IF NOT EXISTS `$this->database`")){
        $mysqli->select_db($this->database);
      }
    }

    //TABLA ARTICULOS
    $query = "CREATE TABLE IF NOT EXISTS `articles` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(255) CHARACTER SET utf8 NOT NULL,
      `topic` varchar(255) CHARACTER SET utf8 NOT NULL,
      `body` mediumtext CHARACTER SET utf8 NOT NULL,
      `tags` varchar(1000) CHARACTER SET utf8 NOT NULL,
      `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `user_id` int(11) NOT NULL,
      `tumbnail` varchar(255) CHARACTER SET utf8 NOT NULL,
      `likes` int(11) NOT NULL DEFAULT '0',
      PRIMARY KEY (`id`),
      KEY `user` (`user_id`),
      KEY `topic` (`topic`)
    );";

    $mysqli->query($query);

    //VOTOS PARA GUESTS!
    $query = "CREATE TABLE IF NOT EXISTS `article_voted` (
      `article_id` int(11) NOT NULL,
      `guest_ip` varchar(15) CHARACTER SET utf8 NOT NULL,
      PRIMARY KEY (`article_id`,`guest_ip`),
      KEY `guest_ip` (`guest_ip`)
    );";

    $mysqli->query($query);

    //TABLA COMENTARIOS!
    $query = "CREATE TABLE IF NOT EXISTS `comments` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `article_id` int(11) NOT NULL,
      `avatar` varchar(255) NOT NULL,
      `name` varchar(255) NOT NULL,
      `body` varchar(10000) NOT NULL,
      `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      KEY `article_id` (`article_id`)
    );";

    $mysqli->query($query);

    //GRAFICA DE PAISES
    $query = "CREATE TABLE IF NOT EXISTS `country_savepoint` (
      `country_name` varchar(255) CHARACTER SET utf8 NOT NULL,
      `contador` int(11) NOT NULL DEFAULT '0',
      PRIMARY KEY (`country_name`)
    );";

    $mysqli->query($query);

    //USUARIOS GUEST!
    $query = "CREATE TABLE IF NOT EXISTS `guest_users` (
      `guest_ip` varchar(15) CHARACTER SET utf8 NOT NULL,
      `time_visited` int(15) NOT NULL,
      `country` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'Spain',
      `os` varchar(255) CHARACTER SET utf8 NOT NULL,
      PRIMARY KEY (`guest_ip`)
    );";

    $mysqli->query($query);

    //TABLA DE FEEDBACK!
    $query = "CREATE TABLE IF NOT EXISTS `mail_box` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) CHARACTER SET utf8 NOT NULL,
      `email` varchar(255) NOT NULL,
      `subject` varchar(255) NOT NULL,
      `message` varchar(255) NOT NULL,
      `watched` tinyint(4) DEFAULT '0',
      PRIMARY KEY (`id`)
    );";

    $mysqli->query($query);

    //CONFIG MAIN PAGE
    $query = "CREATE TABLE IF NOT EXISTS `mp_config` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(255) NOT NULL,
      `description` varchar(255) NOT NULL,
      `ftitle` varchar(255) NOT NULL,
      `fdescription` varchar(255) NOT NULL,
      `mainColor` varchar(255) NOT NULL,
      `fontColor` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    );";

    $mysqli->query($query);

    //MAIN PAGE CONFIG ROW
    $query = "INSERT INTO `mp_config` (`id`, `title`, `description`,`ftitle`, `fdescription` ,`mainColor`, `fontColor`) VALUES (1, '', '', '','', '', '');";

    $mysqli->query($query);

    //CONFIG LANDING PAGE!
    $query = "CREATE TABLE IF NOT EXISTS `lp_config` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(255) NOT NULL,
      `description` varchar(255) NOT NULL,
      `blackcoat` tinyint(1) NOT NULL DEFAULT '1',
      `bg_landing` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    );";

    $mysqli->query($query);

    //LANDING PAGE CONFIG ROW
    $query = "INSERT INTO `lp_config` (`id`, `title`, `description`, `blackcoat`, `bg_landing`) VALUES (1, '', '', '1', '');";

    $mysqli->query($query);

    //TABLA TAGS
    $query = "CREATE TABLE IF NOT EXISTS `tags` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    );";

    $mysqli->query($query);

    //TABLA TOPICS
    $query = "CREATE TABLE IF NOT EXISTS `topics` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `topic` varchar(255) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `name` (`topic`)
    );";

    $mysqli->query($query);

    //TABLA USUARIOS
    $query = "CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(50) NOT NULL,
      `lastname` varchar(50) NOT NULL,
      `username` varchar(50) NOT NULL,
      `password` varchar(76) NOT NULL,
      `email` varchar(100) NOT NULL,
      `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `type` tinyint(1) NOT NULL DEFAULT '0',
      `active` tinyint(1) NOT NULL DEFAULT '0',
      `token` varchar(10) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `username` (`username`),
      UNIQUE KEY `email` (`email`)
    );";

    $mysqli->query($query);

    //USUARIO MASTER
    $query = "INSERT INTO `users` (`id`, `name`, `lastname`, `username`, `password`, `email`, `date`, `type`, `active`, `token`) VALUES
    (1, 'Jonathan', 'Vasquez Morales', 'admin', 'YWRtaW4xMjM=', 'jcammyb@yopmail.com', '2018-06-09 23:24:44', 1, 1, '');";

    $mysqli->query($query);


    //RELACION ARTICULOS TOPICS
    $query = "ALTER TABLE `articles`
      ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`topic`) REFERENCES `topics` (`topic`) ON DELETE CASCADE ON UPDATE CASCADE,
      ADD CONSTRAINT `articles_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";

    $mysqli->query($query);

    //RELACION GUEST USERS Y VOTOS A ARTICULOS
    $query = "ALTER TABLE `article_voted`
      ADD CONSTRAINT `article_voted_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
      ADD CONSTRAINT `article_voted_ibfk_2` FOREIGN KEY (`guest_ip`) REFERENCES `guest_users` (`guest_ip`) ON DELETE CASCADE ON UPDATE CASCADE;";

    $mysqli->query($query);

    //RELACION COMMENTS Y ARTICULOS
    $query = "ALTER TABLE `comments`
      ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;";

    $mysqli->query($query);

    //RELACION COMMENTS Y ARTICULOS
    $query = "CREATE EVENT `guest_remove` ON SCHEDULE EVERY 10 MINUTE ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM guest_users WHERE time_visited<UNIX_TIMESTAMP();";//FIXME: CAMBIAR ESTO PARA SUBIDA

    $mysqli->query($query);

    //TRIGGER PARA GRAFICA DE PAISES!
    $query = "DROP TRIGGER IF EXISTS `save_country`;";

    $mysqli->query($query);

    $query = "CREATE TRIGGER `save_country` AFTER INSERT ON `guest_users` FOR EACH ROW INSERT INTO
      country_savepoint(country_name, contador)
    VALUES
      (NEW.country, 1) ON DUPLICATE KEY
    UPDATE
      contador = contador + 1";

    $mysqli->query($query);
  }
}

?>
