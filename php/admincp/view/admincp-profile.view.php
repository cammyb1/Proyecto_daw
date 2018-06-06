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
    echo "<h1>Tables!!</h1>";

    $all_tables = $_SESSION["tables"];
    $user_table = $all_tables["users"];
    $article_table = $all_tables["articles"];
    $comments_table = $all_tables["comments"];
    $topics_table = $all_tables["topics"];
    $tags_table = $all_tables["tags"];

    if(isset($_GET["tables"])&&(!isset($_GET["u"])&&!isset($_GET["a"])
    &&!isset($_GET["c"])&&!isset($_GET["i"])&&!isset($_GET["t"])&&!isset($_GET["ta"]))){
      foreach($all_tables as $label=>$tables){
        echo "<div><h2>$label</h2>";
        echo "<table class='table table-dark table-bordered'>";
        if(isset($tables[0])){
          $headers = array_keys($tables[0]);

          echo "<tr>";
          foreach ($headers as $value) {
            if($value!="password"){
              echo "<th>".strtoupper($value)."</th>";
            }
          }
          echo "</tr>";
        }

        foreach($tables as $table_name=>$table){

          echo "<tr>";
          foreach ($table as $key=>$value) {
            if($key!="password"){
              echo "<td>".strip_tags($value)."</td>";
            }
          }
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      }
    }else{
      if(isset($_GET["tables"])){
        $used_table = array();
        $name = "";

        if(isset($_GET["u"])){
          $used_table = $user_table;
          $name = "Users";
        }
        if(isset($_GET["a"])){
          $used_table = $article_table;
          $name = "Articles";
        }
        if(isset($_GET["c"])){
          $used_table = $comments_table;
          $name = "Comments";
        }
        if(isset($_GET["t"])){
          $used_table = $topics_table;
          $name = "Topics";
        }
        if(isset($_GET["ta"])){
          $used_table = $tags_table;
          $name = "Tags";
        }

        echo "<div><h2>$name</h2>";
        echo "<table class='table table-dark table-bordered'>";

        if(isset($used_table[0])){
          $headers = array_keys($used_table[0]);

          echo "<tr>";
          foreach ($headers as $value) {
            if($value!="password"){
              echo "<th>$value</th>";
            }
          }
          echo "</tr>";
        }

        foreach($used_table as $table_name=>$table){
          echo "<tr>";
          foreach ($table as $key=>$value) {
            if($key!="password"){
              echo "<td>$value</td>";
            }
          }
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

      }
    }
  }
  //-- FIN TABLAS --




  // -- UI Config!!! --
  if(isset($_GET["config"])){
    echo "<h1>Config!!</h1>";
  }
  // -- FIN Config --
?>
