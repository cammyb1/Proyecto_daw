<?php
  if(isset($_GET["dash"])){
    $dashboard = $_SESSION["dashboard"];

    echo "<h1>DASHBOARD</h1>";

    foreach($dashboard as $label=>$tables){
      echo "<div><h2>$label</h2>";
      echo "<table class='table table-bordered'>";
      if(isset($tables[0])){
        $headers = array_keys($tables[0]);

        echo "<tr>";
        foreach ($headers as $value) {
          if($value!="password"){
            echo "<th>$value</th>";
          }
        }
        echo "</tr>";
      }

      foreach($tables as $table_name=>$table){

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
  if(isset($_GET["articles"])){
    echo "<h1>Articles!!</h1>";
  }
  if(isset($_GET["tables"])){
    echo "<h1>Tables!!</h1>";
  }
  if(isset($_GET["config"])){
    echo "<h1>Config!!</h1>";
  }
?>
