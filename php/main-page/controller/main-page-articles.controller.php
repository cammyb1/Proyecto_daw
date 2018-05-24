<?php
  session_start();


  $consultor = new Consultor("articles");

  $users = $consultor -> getFullTable("users");
  $likes = $consultor -> getFullTable("article_likes");
  $articles = $consultor -> getFullTable($consultor->getTableName());

  $users_names = array();
  $article_likes = array();

  foreach($users as $user){
    $user_id[$user["id"]]=$user[$user["username"]];
  }

  foreach($article_likes as $likes){
    $article_likes[$likes["id"]]=$likes["amount"];
  }

  $_SESSION["users_names"] = $users_names;
  $_SESSION["articles"] = $articles;
  $_SESSION["article_likes"] = $article_likes;
?>
