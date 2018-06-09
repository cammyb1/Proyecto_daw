<?php
  $title = "";
  $subtitle = "";
  $description = "";
  $icon="fa-tachometer-alt";

  if(isset($GET["dsb_t"])){
    $title = $GET["dsb_t"];
  }
  if(isset($GET["dsb_st"])){
    $subtitle = $GET["dsb_st"];
  }else{
    $subtitle = $title;
  }
  if(isset($GET["dsb_d"])){
    $description = $GET["dsb_d"];
  }
  if(isset($GET["dsb_i"])){
    $icon = $GET["dsb_i"];
  }
?>
<div>
  <div class="d-flex justify-content-between">
    <h5 class='h2 align-self-center'><?php echo $title ?></h5>
    <span class="align-self-center">
      <i class="fa <?php echo $icon?>"></i>
      <small><?php echo $subtitle?></small>
    </span>
  </div>
  <div class='clearfix'>
    <p class='float-left'><?php echo $description ?></p>
    <p class='float-right'><i class="far fa-clock"></i> : <span id='ct-db'></span></p>
  </div>
</div>
