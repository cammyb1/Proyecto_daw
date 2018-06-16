<?php
  $_GET["dsb_t"]="Config";
  $_GET["dsb_d"]="Here you can modify all kind of stuff";
  $_GET["dsb_i"]="fa-wrench";

  include "../MainComponents/vista/common-dashboar.view.php";
?>
<div class="container">
  <?php
    if($_SESSION["usuario"]->getType()!=1){
      echo "<div class='alert alert-warning'>Sorry you dont have permissions :(</div>";
    }else{
  ?>
    <div class="container config_panel">
      <div class="row row_container">
        <div class="col-md-2 nav_panel">
          <ul class="list-group">
            <li class="list-group-item"><a class="active" href="#home" data-toggle="tab">Mail</a></li>
            <li class="list-group-item"><a href="#mp" data-toggle="tab">Main page</a></li>
            <li class="list-group-item"><a href="#lp" data-toggle="tab">Landing page</a></li>
          </ul>
        </div>
        <div class="col-md-10 main_content">
          <div class="tab-content" id='content'>
            <div class="tab-content">
              <div class="tab-pane fade in show active" id='home'>
                <div class='clearfix d-flex align-items-center'>
                  <h1>Mail</h1>
                  <a class="text-success p-4" id="refresh_mails"><i class="fa fa-sync"></i></a>
                </div>
                <div id='mail-content'></div>
              </div>
              <div id='mp' class="tab-pane fade">
                <div id="alert_mp"></div>
                <h1>Main page configuration.</h1>
                <hr>
                <form name='mp_form'>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <input name="title" class="form-control" type="text" maxlength="255" placeholder="Main title" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Main description" maxlength="255" style="resize:none"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <input name="ftitle" type="text" class="form-control" placeholder="Footer title" maxlength="255">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <textarea name="fdescription" class="form-control" placeholder="Footer description" maxlength="255" style="resize:none"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="">Main color</label>
                        <input name="mainColor" type="color" class="form-control">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="">Font Color</label><input class="form-control" name="fontColor" type="color">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name='table_name' value='mp_config'>
                    <input type='hidden' name='elem_id' value='1' />
                  </div>
                </form>
                <Button id='send_mp' class="btn btn-dark">Update Main Page</Button>
              </div>
              <div id='lp' class="tab-pane fade">
                <div id="alert_lp"></div>
                <h1>Landing page configuration.</h1>
                <hr>
                <form name='lp_form'>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <input name="title" type="text" class="form-control" maxlength="255" placeholder="Title" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <textarea name="description" class="form-control" maxlength="255" placeholder="Description" required style="resize:none"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                          <label for="">Background image <span class="text-danger">(1920x1080)</span></label>
                          <input name="bg_landing" class="form-control-file file" type="file" accept=".jpg,.jpeg,.png" required id="file">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label class="form-check-label">Black coat</label>
                        <input name="blackcoat"  type="checkbox">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name='table_name' value='lp_config'>
                    <input type='hidden' name='elem_id' value='1' />
                  </div>
                </form>
                <Button id='send_lp' class="btn btn-dark ">Update Landing</Button>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  <?php
      }
  ?>
</div>
