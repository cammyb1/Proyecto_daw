<?php
  $used_config = array();
  $used_config=array(
    "blackcoat"=>true,
    "bg_landing"=>"../../resources/machu-picchu.jpg",
    "title"=>"Machu Picchu",
    "description"=>"Discover the greatest and biggest civilization of South America"
  );

  if(isset($_SESSION["landing_config"])){
    $used_config=$_SESSION["landing_config"];
  }else{
    $used_config = $used_config;
  }
?>

<div class="row">
  <div class="container-fluid fullvh">
    <div class="col">
      <?php $used_config["blackcoat"]?"<div class='blackcoat'></div>":""?>
      <div class="main-content">
        <img src="<?php echo $used_config["bg_landing"]?>" alt="BG_LANDING">
        <div class='landing-box'>
          <div class="landing-title">
            <?php echo $used_config["title"]?>
          </div>
          <div class="landing-description">
            <?php echo $used_config["description"]?>
          </div>
          <div class="landing-button">
            <a class="btn btn-primary" href="../main-page/index.php"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
