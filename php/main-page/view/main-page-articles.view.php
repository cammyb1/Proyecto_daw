<?php

  $articles = $_SESSION["articles"];
  $users_names = $_SESSION["users_names"];
  $article_likes = $_SESSION["article_likes"];
  $pagination = $_SESSION["pagination"];
  $found = false;

  if(isset($articles)){
    if(sizeof($articles)>0){
      $found = true;
      foreach($articles as $article){
        $article_date = date($article["date"]);

        echo '
          <article>
            <div class="upper">
              <h1>'.$article["title"].'</h1>
              <div>
                <span>'.date("h:i A",strtotime($article_date)).'</span>/<span>'.$users_names[$article["user_id"]].'</span>/<span>'.$article["topic"].'</span>/<span>'.$article_likes[$article["article_id"]].'</span>
              </div>
            </div>
            <div class="lower">
              <img src="../../resources/tumbnails/'.$article["tumbnail"].'" alt="previewimg">
              <p>'.$article["body"].'</p>
              <div class="share">
                <span>Share this at</span>
              </div>
            </div>
            <div class="more">
              <a href="index.php?article='.$article["article_id"].'">+</a>
            </div>
          </article>
        ';
      }
    }else{
      echo "<span>No se encontraron articulos</span>";
    }
  }

  if($found){
    echo '
        <div class="pagination">
          '.$pagination.'
        </div>
    ';
  }
?>
