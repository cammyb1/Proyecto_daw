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
      $lp_form_data = array(
        "title"=>"",
        "description"=>"",
        "navColor"=""
      );
      $mp_form_data = array(
        "title"=>"",
        "description"=>"",
        "blackcoat"=>false,
        "bg_landing"=>"123.png"
      );
  ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-4">
          <ul class="list-group" id="config_nav">
            <li class='list-group-item'>
              <a href="#nav-mail" class="nav-link nav-item" data-toggle="tab" role="tab">Mail box</a>
            </li>
            <li class='list-group-item nav-item'>
              <a class="nav-link nav-item" href="#uiconfig" data-toggle="collapse" data-parent="#config_nav">UI Config</a>
            </li>
            <ul class="list-group collapse" id="uiconfig">
              <li class='list-group-item nav-item'>
                <a href="#nav-mp" class="nav-link nav-item sub" data-toggle="tab" role="tab">Main Page</a>
              </li>
              <li class='list-group-item nav-item'>
                <a href="#nav-lp" class="nav-link nav-item sub" data-toggle="tab" role="tab">Landing Page</a>
              </li>
            </ul>
          </ul>
        </div>
        <div class="col-xs-8">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane" id='nav-mail' role="tabpanel">
              <h1>Mail</h1>
            </div>
            <div class="tab-pane" id='nav-mp' role="tabpanel">
              <h3><u>Main page configuration.</u></h3>
              <form name='lp_form'>
                <div class="form-group">
                  <label for="">Title</label>
                  <input name="title" type="text" value="<?php echo $mp_form_data["title"];?>">
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea name="description" rows="8" cols="80" maxlength="255"><?php echo $mp_form_data["description"];?></textarea>
                </div>
                <div class="form-group">
                  <label for="">Color</label><input name="navColor" type="color" value="<?php echo $mp_form_data["navColor"];?>">
                </div>
                <div class="form-group">
                  <Button id='send_lp' class="btn btn-primary form-control">Send</Button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id='nav-lp' role="tabpanel">
              <h3><u>Landing page configuration.</u></h3>
              <form name='mp_form'>
                <div class="form-group">
                  <label for="">Title</label>
                  <input name="title" type="text" value="<?php echo $lp_form_data["title"];?>">
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea name="description" rows="8" cols="80" maxlength="255"><?php echo $lp_form_data["description"];?></textarea>
                </div>
                <div class="form-group">
                  <label for="">Black coat</label><input name="blackcoat" type="checkbox" checked="<?php echo $lp_form_data["blackcoat"];?>">
                </div>
                <div class="form-group">
                  <label for="">Background image <span class="text-danger">(1920x1080)</span></label><input name="bg_landing" type="file" value="<?php echo $lp_form_data["bg_landing"];?>">
                </div>
                <div class="form-group">
                  <Button id='send_lp' class="btn btn-primary form-control">Send</Button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
      }
  ?>
</div>
