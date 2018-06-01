<?php
  session_start();

  include "model/main-page-articles.model.php";



  $consultor = new Consultor("articles");

  $users = $consultor -> getFullTable("users");
  $likes = $consultor -> getFullTable("article_likes");


  //ARTICLES PAGINATION
  $results_per_page = 10;
  $pagination = array();
  $number_of_results = $consultor -> getTableSize("articles");
  $number_of_pages = ceil($number_of_results/$results_per_page);

  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }


  $this_page_first_result = ($page-1)*$results_per_page;

  //Save user_names with id key and articles likes with article_id key
  $users_names = array();
  $article_likes = array();

  foreach($users as $user){
    $users_names[$user["id"]]=$user["username"];
  }

  foreach($likes as $like){
    $article_likes[$like["article_id"]]=$like["likes"];
  }

  //Save links for pagination
  for($page=1;$page<=$number_of_pages;$page++){
    $pagination[] = '<a href="?page='.$page.'">'.$page.'</a>';
  }

  $articles = $consultor -> getLimitedTable($consultor->getTableName(),$this_page_first_result,$results_per_page);

  $_SESSION["users_names"] = $users_names;
  $_SESSION["articles"] = $articles;
  $_SESSION["article_likes"] = $article_likes;
  $_SESSION["pagination"] = implode(" | ",$pagination);


  include "view/main-page-articles.view.php";
?>
