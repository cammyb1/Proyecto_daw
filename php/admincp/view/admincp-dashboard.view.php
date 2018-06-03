<?php
  $articles = $_SESSION["tables"]["articles"];
  $user = $_SESSION["usuario"];
  $total_articles = sizeof($articles);
  $guest_users_count = $_SESSION["guest_users"];
?>
<div class="row">
  <div class="col-md-3">
    <div class="card card-primary">
        <div class="card-header">User info</div>
        <div class="card-body">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-user-tie" style="font-size:50px;"></i>
            </div>
            <div class="col-xs-9">
              <p>Welcome <strong><?php echo $user->getUsername();?></strong>!</p>
              <p>There are a total of <?php echo $guest_users_count; ?> visitors!</p>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">Last <b>5</b> articles</div>
        <div class="card-body">
          <ul class='list-group'>
          <?php
              for($i=0;$i<5;$i++){
                $article = isset($articles[($total_articles-1)-$i])?$articles[($total_articles-1)-$i]:null;
                if(isset($article)){
                  echo "<li class='list-group-item'><span class='badge badge-primary'>".($i+1)."</span> ".$article["title"]." <span class='float-right'>".date("H:i a",strtotime($article["date"]))."</span></li>";
                }
              }
          ?>
          </ul>
        </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card card-primary">
        <div class="card-header">Last <b>5</b> comments</div>
        <div class="card-body">
        </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-3">
    <div class="card card-primary">
        <div class="card-header">Server info</div>
        <div class="card-body">
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">Most visited countries</div>
        <div class="card-body">

        </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card card-primary">
        <div class="card-header">Tables metrics</div>
        <div class="card-body">
        </div>
    </div>
  </div>
</div>
