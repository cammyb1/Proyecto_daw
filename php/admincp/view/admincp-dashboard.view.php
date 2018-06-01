<?php
  $articles = $_SESSION["tables"]["articles"];
  $user = $_SESSION["usuario"];
  $total_articles = sizeof($articles);
?>
<div class="row">
  <div class="col-md-3">
    <div>
      <p>
        <span>Welcome </span><strong><?php echo $user->getUsername();?></strong><span>!</span><br>
        <small>There are a total of <strong><?php echo $total_articles?></strong> articles, these are the last 5</small>
      </p>
    </div>
    <div>
      <?php
          echo "<ul class='list-group'>";
          for($i=0;$i<5;$i++){
            $article = isset($articles[($total_articles-1)-$i])?$articles[($total_articles-1)-$i]:null;
            if(isset($article)){
              echo "<li class='list-group-item'><span class='badge badge-primary'>".($i+1)."</span> ".$article["title"]." <span class='float-right'>".date("H:i a",strtotime($article["date"]))."</span></li>";
            }
          }
          echo "</ul>";
      ?>
    </div>
  </div>
  <div class="col-md-6">
    asdasd
  </div>
  <div class="col-md-3">
    asdasdasd
  </div>
</div>
