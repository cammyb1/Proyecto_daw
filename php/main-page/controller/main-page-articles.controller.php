<?php
  include "model/main-page.model.php";

  $consultor = new Consultor();

  //GUEST USER!
  $time = time();
  $guest_timeout = $time - (2*60);
  $current_ip = $_SERVER["REMOTE_ADDR"];
  $geo_data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$current_ip));
  $current_country = $geo_data["geoplugin_countryName"];
  $current_os = $consultor->getOS($_SERVER["HTTP_USER_AGENT"]);

  if(isset($_SESSION["usuario"])){
    $consultor->removeElement("guest_users",["guest_ip=$current_ip"]);
  }else{
    $consultor->insertElement("guest_users",["guest_ip","time_visited","country","os"],[$current_ip,$time,$current_country,$current_os]);
  }

   $consultor->removeElement("guest_users",["time_visited<$guest_timeout"]);
?>
