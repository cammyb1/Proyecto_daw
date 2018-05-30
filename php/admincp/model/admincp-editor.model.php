<?php
  $logger = new Logger();

  if(isset($_POST["enviar"])){
    $file = $_POST["article_tumb"];
    $file_name = $file["name"];
    $file_size = $file["size"];

    $logger->console($file_size);
  }
?>
