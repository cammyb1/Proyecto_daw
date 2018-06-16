<?php
  // -- DASHBOARD!!! --
  if(sizeof($_GET)==0){
    include "view/admincp-dashboard.view.php";
  }
  // -- FIN dashboard!!! --



  // -- Articles!!! --
  if(isset($_GET["articles"])){
    include "view/admincp-editor.view.php";
  }
  // -- FIN Articles!!! --




  // -- TABLAS!!! --
  if(isset($_GET["tables"])){

    $all_tables = $_SESSION["tables"];
    $all_headers = $_SESSION["table_headers"];
    $user_table = $all_tables["users"];
    $article_table = $all_tables["articles"];
    $comments_table = $all_tables["comments"];
    $topics_table = $all_tables["topics"];
    $tags_table = $all_tables["tags"];

    $used_table = array();
    $table_headers = array();
    $name = "";
    $icon = "";

    if(isset($_GET["u"])){
      $used_table = $user_table;
      $name = "Users";
      $icon = "fa-user";
    }
    if(isset($_GET["a"])){
      $used_table = $article_table;
      $name = "Articles";
      $icon = "fa-file-alt";
    }
    if(isset($_GET["c"])){
      $used_table = $comments_table;
      $name = "Comments";
      $icon = "fa-comments";
    }
    if(isset($_GET["t"])){
      $used_table = $topics_table;
      $name = "Topics";
      $icon = "fa-list-alt";
    }
    if(isset($_GET["ta"])){
      $used_table = $tags_table;
      $name = "Tags";
      $icon = "fa-tags";
    }

    $table_headers = $all_headers[strtolower($name)];

    $_GET["dsb_t"]=$name;
    $_GET["dsb_d"]=sizeof($used_table)>0?"Here you can see all the $name in the database":"Your database does not have enought data to show.";
    $_GET["dsb_i"]=$icon;


    include "../MainComponents/vista/common-dashboar.view.php";

    $_GET["used_table"] = $used_table;
    $_GET["t_name"]= $name;
    $_GET["table_headers"] = $table_headers;

    include "./view/admicp-tables.view.php";
  }
  //-- FIN TABLAS --




  // -- UI Config!!! --
  if(isset($_GET["config"])){
    include "view/admincp-config.view.php";
  }
  // -- FIN Config --
?>
