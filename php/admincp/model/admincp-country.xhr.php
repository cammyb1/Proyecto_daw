<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/Article.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");

  $consultor = new Consultor();
  $countries = $consultor->getFullTable("country_savepoint");
  $total_of_votes = array_map("array_sum",$countries);
  $total_of_votes = array_sum($total_of_votes);
  $result = array();

  foreach($countries as $countrie){
    if($countrie["country_name"]!=""){
      $result[] = array(
        "label"=>ucfirst($countrie["country_name"]),
        "y"=> ($countrie["contador"]*100)/$total_of_votes
      );
    }
  }

  echo json_encode($result);
?>
