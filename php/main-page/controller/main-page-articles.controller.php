<?php
  session_start();

  include "model/main-page-articles.model.php";



  $consultor = new Consultor("articles");

  $users = $consultor -> getFullTable("users");
  $likes = $consultor -> getFullTable("article_likes");
  $articles = $consultor -> getFullTable($consultor->getTableName());

  $users_names = array();
  $article_likes = array();

  foreach($users as $user){
    $users_names[$user["user_id"]]=$user["username"];
  }

  foreach($likes as $like){
    $article_likes[$like["article_id"]]=$like["likes"];
  }

  $_SESSION["users_names"] = $users_names;
  $_SESSION["articles"] = $articles;
  $_SESSION["article_likes"] = $article_likes;


  include "view/main-page-articles.view.php";
?>
