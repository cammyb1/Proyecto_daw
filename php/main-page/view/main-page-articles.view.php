<?php

  $articles = $_SESSION["articles"];
  $users_names = $_SESSION["users_names"];
  $article_likes = $_SESSION["article_likes"];

  if(isset($articles)){
    foreach($articles as $article){
      $article_date = date($article["fecha"]);


      echo `
        <article>
          <div class="upper">
            <h1>{$article["title"]}</h1>
            <div>
              <span>{date("h:i A",$article_date)}</span>/<span>{$users_names[$articles["user_id"]]}</span><span>{$article["topic"]}</span><span>{$article_likes[$article["id"]]}</span>
            </div>
          </div>
          <div class="lower">
            <img src="" alt="previewimg">
            <p>{$article["body"]}</p>
            <div class="share">
              <span>Share this at</span>
            </div>
          </div>
          <div class="more">
            <a href="?{$article["id"]}">+</a>
          </div>
        </article>
      `;
    }
  }else{
    echo "<span>No se encontraron articulos</span>";
  }

?>
