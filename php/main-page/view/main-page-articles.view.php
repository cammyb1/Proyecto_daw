<?php

  $articles = $_SESSION["articles"];
  $users_names = $_SESSION["users_names"];
  $article_likes = $_SESSION["article_likes"];

  if(isset($articles)){
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
            <img src="" alt="previewimg">
            <p>'.$article["body"].'</p>
            <div class="share">
              <span>Share this at</span>
            </div>
          </div>
          <div class="more">
            <a href="?'.$article["article_id"].'">+</a>
          </div>
        </article>
      ';
    }
  }else{
    echo "<span>No se encontraron articulos</span>";
  }

?>
