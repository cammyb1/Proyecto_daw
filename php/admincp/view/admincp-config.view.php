<?php
  $_GET["dsb_t"]="Config";
  $_GET["dsb_d"]="Here you can modify all kind of stuff";

  include "../MainComponents/vista/common-dashboar.view.php";
?>
<div class="container">
  <?php
    if($_SESSION["usuario"]->getType()!=1){
      echo "<div class='alert alert-warning'>Sorry you dont have permissions :(</div>";
    }else{
  ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-4">
          <ul class="nav flex-column" id="config_nav">
            <li class="nav-item">
              <a class="nav-link active" href="#">Mail box</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">UI Config</a>
              <ul>
                <li><a href="" class="nav-link sub">Main Page</a></li>
                <li><a href="" class="nav-link sub">Landing Page</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
          </ul>
        </div>
        <div class="col-xs-8">
          Here goes all the config body!
        </div>
      </div>
    </div>
  <?php
      }
  ?>
</div>
