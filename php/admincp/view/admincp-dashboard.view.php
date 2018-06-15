<?php
  $articles = $_SESSION["tables"]["articles"];
  $comments = $_SESSION["tables"]["comments"];
  $user = $_SESSION["usuario"];
  $total_articles = sizeof($articles);
  $total_comments = sizeof($comments);
  $total_memory = number_format(memory_get_usage()/1024,2);

  $_GET["dsb_t"]="Dashboard";
  $_GET["dsb_d"]="Here you can see your metrics and common info of the website.";

  include "../MainComponents/vista/common-dashboar.view.php";
?>
<div class="row">
  <div class="col-md-4">
    <div class="card card-primary mt-4">
        <div class="card-header"><i class="fa fa-address-book"></i> User info</div>
        <div class="card-body">
          <div class="row container">
            <div class="col-md-3 d-flex align-items-center justify-content-center user-info">
              <i class="fa fa-user-tie"></i>
            </div>
            <div class="col-md-9 d-flex align-items-center">
              <ul >
                <li><p>Welcome <strong><?php echo $user->getName();?></strong>!</p></li>
                <hr>
                <li><p>Your role here is <b><?php echo $user->getType()==1?"Web master":"Moderator";?></b></p></li>
                <hr>
                <li><p>There are a total of <strong id="visitors">0</strong> visitors right now!</p></li>
                <hr>
                <li><p>Your ip is <strong><u><?php echo $_SERVER["REMOTE_ADDR"] ?></u></strong></p></li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary mt-4">
        <div class="card-header"><i class="fa fa-book-open"></i> Last <b>5</b> posts</div>
        <div class="card-body">
          <ul class='list-group posts_list'>
          <?php
              if($total_articles>0){
                for($i=0;$i<5;$i++){
                  $article = isset($articles[($total_articles-1)-$i])?$articles[($total_articles-1)-$i]:null;
                  if(isset($article)){
                    echo "<li class='list-group-item ".($i==0?"active":"")." '><span class='badge badge-dark'>".($i+1)."</span> ".$article["title"]." <span class='float-right'>".date("H:i a",strtotime($article["date"]))."</span></li>";
                  }
                }
              }else{
                echo "<div class='alert alert-warning'>There are no posts yet <i class='far fa-frown'></i></div>";
              }
          ?>
          </ul>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary  mt-4">
        <div class="card-header"><i class="fa fa-comment"></i> Last <b>3</b> comments</div>
        <div class="card-body">
          <ul class="list-group">
            <?php
                if($total_comments>0){
                  for($i=0;$i<5;$i++){
                    $comment = isset($comments[($total_comments-1)-$i])?$comments[($total_comments-1)-$i]:null;
                    if(isset($comment)){
                      echo '
                      <li class="list-group-item '.($i==0?"active":"").' ">
                        <div class="media">
                          <img class="mr-3" src="../../resources/avatars/'.$comment["avatar"].'" alt="Avatar" />
                          <div class="media-body">
                            <h5 class="mt-0">'.$comment["name"].'</h5>
                            <p>'.strip_tags($comment["body"]).'</p>
                          </div>
                        </div>
                      </li>'
                      ;
                    }
                  }
                }else{
                  echo "<div class='alert alert-warning'>There are no comments yet <i class='far fa-frown'></i></div>";
                }
            ?>
          </ul>
        </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-4">
    <div class="card card-primary  mt-4">
        <div class="card-header"><i class="fa fa-server"></i> Server info</div>
        <div class="card-body">
          <ul>
            <li><b>Server name: </b><?php echo $_SERVER["SERVER_NAME"] ?></li>
            <hr>
            <li><b>Server IP: </b><?php echo $_SERVER["SERVER_ADDR"] ?></li>
            <hr>
            <li><b>Server software: </b><?php echo explode("/",$_SERVER["SERVER_SOFTWARE"])[0] ?></li>
            <hr>
            <li><b>Server port: </b><?php echo $_SERVER["SERVER_PORT"] ?></li>
            <hr>
            <li><b>Total memory: </b><?php echo $total_memory . " <small>MB</small>" ?></li>
          </ul>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary  mt-4">
        <div class="card-header"><i class="fa fa-globe"></i> Most visited countries <a class="float-right text-white" id="mvc_refresh"><i class="fa fa-sync"></i></a></div>
        <div class="card-body">
          <div id="most_visited_c" style="height: 440px;">
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary  mt-4">
        <div class="card-header"><li class="fa fa-chart-bar"></li> Tables metrics <a class="float-right text-white" id="tm_refresh"><i class="fa fa-sync"></i></a></div>
        <div class="card-body">
          <div id="table-metrics" style="height: 440px;">
          </div>
        </div>
    </div>
  </div>
</div>
