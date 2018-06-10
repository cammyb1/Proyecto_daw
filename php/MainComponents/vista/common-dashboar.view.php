<?php
  $title = "";
  $subtitle = "";
  $description = "";
  $icon="fa-tachometer-alt";

  if(isset($_GET["dsb_t"])){
    $title = $_GET["dsb_t"];
  }
  if(isset($_GET["dsb_st"])){
    $subtitle = $_GET["dsb_st"];
  }else{
    $subtitle = $title;
  }
  if(isset($_GET["dsb_d"])){
    $description = $_GET["dsb_d"];
  }
  if(isset($_GET["dsb_i"])){
    $icon = $_GET["dsb_i"];
  }

  $random_facts = array(
    "The Eiffel Tower can grow more than six inches during the summer",
    "The inventor of the microwave appliance only received $2 for his discovery",
    "Humans aren’t the only animals that dream",
    "Europeans were scared of eating tomatoes when they were introduced",
    "There’s only one U.S. state capital without a McDonald’s",
    "Giraffe tongues can be 20 inches long",
    "Theodore Roosevelt had a pet hyena",
    "The U.S. government saved every public tweet from 2006 through 2017"
  );
?>
<div class="row">
  <div class="container-fluid info-dash">
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
    <div class="alert alert-info alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Interesting facts!</strong> <?php echo $random_facts[rand(0,sizeof($random_facts)-1)]?>.
    </div>
  </div>
</div>
