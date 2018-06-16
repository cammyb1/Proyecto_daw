<?php
  $title = "";
  $description = "";
  $redirection = "";
  $all_set = false;
  if($_GET["title"]&&$_GET["desc"]&&$_GET["redir"]){
    $all_set=true;
  }


  if($all_set){
    $title = $_GET["title"];
    $description = $_GET["desc"];
    $redirection = $_GET["redir"];

    $body = "
      <div>
        <h4>$title</h4>
        <p>$description</p>
        <a href='$redirection'>GO!</a>
      </div>
    ";

    return $body;
  }
?>
