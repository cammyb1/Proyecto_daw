<?php
  $articles = $_SESSION["tables"]["articles"];
  $comments = $_SESSION["tables"]["comments"];
  $user = $_SESSION["usuario"];
  $total_articles = sizeof($articles);
  $total_comments = sizeof($comments);
  $total_memory = number_format(memory_get_usage()/1024,2);
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
<div class="row clearfix">
  <div class="col-md-12">
    <div class="alert alert-info alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Interesting facts!</strong> <?php echo $random_facts[rand(0,sizeof($random_facts)-1)]?>.
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="card card-primary">
        <div class="card-header"><i class="fa fa-address-book"></i> User info</div>
        <div class="card-body">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-user-tie" style="font-size:50px;"></i>
            </div>
            <div class="col-xs-9">
              <ul>
                <li><p>Welcome <strong><?php echo $user->getUsername();?></strong>!</p></li>
                <li><p>There are a total of <strong id="visitors">0</strong> visitors right now!</p></li>
                <li><p>Your ip is <strong><?php echo $_SERVER["REMOTE_ADDR"]  ?></strong></p></li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header"><i class="fa fa-book-open"></i> Last <b>5</b> posts</div>
        <div class="card-body">
          <ul class='list-group'>
          <?php
              if($total_articles>0){
                for($i=0;$i<5;$i++){
                  $article = isset($articles[($total_articles-1)-$i])?$articles[($total_articles-1)-$i]:null;
                  if(isset($article)){
                    echo "<li class='list-group-item'><span class='badge badge-primary'>".($i+1)."</span> ".$article["title"]." <span class='float-right'>".date("H:i a",strtotime($article["date"]))."</span></li>";
                  }
                }
              }else{
                echo "<li class='list-group-item'>There is no posts yet <i class='far fa-frown'></i></li>";
              }
          ?>
          </ul>
        </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card card-primary">
        <div class="card-header"><i class="fa fa-comment"></i> Last <b>3</b> comments</div>
        <div class="card-body">
          <ul class="list-group">
            <?php
                if($total_comments>0){
                  for($i=0;$i<5;$i++){
                    $comment = isset($comments[($total_comments-1)-$i])?$comments[($total_comments-1)-$i]:null;
                    if(isset($comment)){
                      echo '
                      <li class="list-group-item">
                        <div class="media">
                          <img class="mr-3" src="../../resources/avatars/'.$comment["avatar"].'" alt="Avatar" />
                          <div class="media-body">
                            <h5 class="mt-0">'.$comment["name"].'</h5>
                            '.$comment["body"].'
                          </div>
                        </div>
                      </li>'
                      ;
                    }
                  }
                }else{
                  echo "<li class='list-group-item'>There is no comments yet <i class='far fa-frown'></i></li>";
                }
            ?>
          </ul>
        </div>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-3">
    <div class="card card-primary">
        <div class="card-header"><i class="fa fa-server"></i> Server info</div>
        <div class="card-body">
          <ul>
            <li><b>Server name: </b><?php echo $_SERVER["SERVER_NAME"] ?></li>
            <li><b>Server IP: </b><?php echo $_SERVER["SERVER_ADDR"] ?></li>
            <li><b>Server software: </b><?php echo explode("/",$_SERVER["SERVER_SOFTWARE"])[0] ?></li>
            <li><b>Server port: </b><?php echo $_SERVER["SERVER_PORT"] ?></li>
            <li><b>Total memory: </b><?php echo $total_memory . " <small>MB</small>" ?></li>
          </ul>
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header"><i class="fa fa-globe"></i> Most visited countries <a class="float-right text-primary" id="mvc_refresh"><i class="fa fa-sync"></i></a></div>
        <div class="card-body">
          <div id="most_visited_c" style="height: 440px;">
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card card-primary">
        <div class="card-header"><li class="fa fa-chart-bar"></li> Tables metrics <a class="float-right text-primary" id="tm_refresh"><i class="fa fa-sync"></i></a></div>
        <div class="card-body">
          <div id="table-metrics" style="height: 440px;">
          </div>
        </div>
    </div>
  </div>
</div>
