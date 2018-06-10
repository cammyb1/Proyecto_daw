<?php
  session_start();

  if(isset($_SESSION["tables"])){
    $mails = $_SESSION["tables"]["mail_box"];
    $result = 0;

    foreach($mails as $mail){
      if($mail["watched"]=="0"){
        $result++;
      }
    }
  }

  echo $result;
?>
