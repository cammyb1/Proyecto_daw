<?php
  session_start();

  $result = 0;

  if(isset($_SESSION["tables"])){
    $mails = $_SESSION["tables"]["mail_box"];

    foreach($mails as $mail){
      if($mail["watched"]=="0"){
        $result++;
      }
    }
  }

  echo $result;
?>
