<?php
  $_GET["dsb_t"]="Config";
  $_GET["dsb_d"]="Here you can modify all kind of stuff";

  include "../MainComponents/vista/common-dashboar.view.php";
?>
<div class="container">
  <nav class="nav flex-column">
    <a class="nav-link active" href="#">Active</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link disabled" href="#">Disabled</a>
  </nav>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>
</div>
