<?php
  session_start();

  if(isset($_SESSION["tables"])){
    $countries = $_SESSION["tables"]["country_savepoint"];
    $total_of_votes = array_map("array_sum",$countries);
    $total_of_votes = array_sum($total_of_votes);
    $result = array();

    foreach($countries as $contry){
      if($contry["country_name"]!=""){
        $result[] = array(
          "label"=>ucfirst($contry["country_name"]),
          "y"=> ($contry["contador"]*100)/$total_of_votes
        );
      }
    }
  }


  echo json_encode($result);
?>
