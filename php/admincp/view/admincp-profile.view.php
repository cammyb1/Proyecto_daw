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

        $GET["dsb_t"]=$name;
        $GET["dsb_d"]=sizeof($used_table)>0?"Here you can see all the $name in the database":"Your database does not have enought data to show.";


        include "../MainComponents/vista/common-dashboar.view.php";
        if(sizeof($used_table)<=0){
          echo "<div class='alert alert-warning'>There are no $name yet <i class='far fa-frown'></i></div>";
        }
        echo "<div id='downlad_tables'>
        <table class='table table-dark table-bordered'>
        <thead>
        <tr>
          <th colspan='".(sizeof($used_table)>0?sizeof($used_table[0])+1:1)."' class='bg-secondary'>
            <div>
              <div class='inner-addon left-addon'>
                <i class='fa fa-search'></i>
                <input type='text' id='searchBar'/>
                <div class='float-right'>
                  <a class='btn text-white' href=''><i class='fa fa-sync'></i></a>
                  <a class='btn btn-success' id='table_add' href='".($name=="Articles"?"profile.php?articles":"")."'><i class='fa fa-plus'></i></a>
                </div>
              </div>
            </div>
          </th>
        </tr>";

        if(sizeof($used_table)>0){
          $headers_as_options = ["options"=>"","theads"=>""];
          $excluded_values = [
            "options"=>["body","avatar","password"],
            "theads"=>["password"],
            "td_editables"=>["id","date","article_id","user_id"]
          ];

          if(isset($used_table[0])){
            $headers = array_keys($used_table[0]);

            foreach ($headers as $value) {
              !in_array($value,$excluded_values["theads"])?$headers_as_options["theads"].="<th>$value</th>":"";
            }
          }

          if(sizeof($headers_as_options["theads"])>0){
            echo "<tr>".$headers_as_options["theads"]."<th>Options</th></tr>";
          }
          echo "</thead><tbody id='tabla'>";
          foreach($used_table as $table){
            echo "<tr id='".strtolower($name)."_".$table['id']."'>";
            foreach ($table as $key=>$value) {
              if($key!="password"){
                echo in_array($key,$excluded_values["td_editables"])?"<td><div>$value</div></td>":"<td><div class='table_data' edit_type='click' col_name='$key'>$value</div></td>";
              }
            }
            echo "
              <td>
                  <button class='btn btn-primary edit_table'><i class='fa fa-pencil-alt'></i></button>
                  <button class='btn btn-danger save_table'><i class='fa fa-save'></i></button>
                  <button class='btn btn-secondary cancel_table'><i class='fa fa-times'></i></button>
                  ".((strtolower($name)=="users"&&$_SESSION["usuario"]->getId()==$table['id'])?"":"<a class='btn btn-danger delete_table' href=''><i class='fa fa-trash'></i></a>")."
              </td>
            </tr>";
          }
        }
        echo "</tbody></table>";
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
