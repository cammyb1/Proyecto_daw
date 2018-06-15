<?php
  include "../model/main-page-articles.model.php";
  session_start();

  $consultor = new Consultor();
  $logger = new Logger();

  $users = $consultor -> getTableComplex("users",["id","username"]);

  $users_names = array();

  foreach($users as $user){
    $users_names[$user["id"]] = $user["username"];
  }

  if(isset($_POST["page"])){

    $pn = $_POST["page"];
    $topic = array();

    $results_per_page = 5;

    if(isset($_POST["topic"])){
      $topic[] = "topic='".$_POST["topic"]."'";
    }

    $number_of_results = count($consultor -> getTableComplex("articles",["*"],$topic));
    $number_of_pages = ceil($number_of_results/$results_per_page);

    if ($pn < 1) {
        $pn = 1;
    } else if ($pn > $number_of_pages) {
        $pn = $number_of_pages;
    }

    $this_page_first_result = ($pn-1)*$results_per_page;

    $articles = $consultor -> getLimitedTable("articles",$this_page_first_result,$results_per_page,"date",$topic);

    if(isset($articles)){
      if(sizeof($articles)>0){
        foreach($articles as $article){
          $article_date = date($article["date"]);
          $article_tumbnail = explode("/",$article["tumbnail"]);

          echo '
            <article class="preview">
              <div class="upper">
                <h1>'.$article["title"].'</h1>
                <div>
                  <span><i class="far fa-clock"></i> '.date("h:i A",strtotime($article_date)).'</span>
                  <span><i class="fa fa-user"></i> '.$users_names[$article["user_id"]].' </span>
                  <span><i class="fa fa-list-alt"></i> '.$article["topic"].' </span>
                  <span><i class="fa fa-heart"></i> '.$article["likes"].' </span>
                </div>
              </div>
              <div class="lower">
                <div class="row">
                  <div class="col-xs-3">
                    <img src="../../resources/images/'.end($article_tumbnail).'" alt="previewimg">
                  </div>
                  <div class="col content">
                    <p id="test">'.strip_tags($article["body"]).'</p>
                  </div>
                </div>
              </div>
              <div class="more d-flex justify-content-md-end">
                <a class="btn send_love" article_id='.$article["id"].'><i class="fa fa-heart"></i></a>
                <a class="btn mainTextColor" href="index.php?article='.$article["id"].'"><i class="fa fa-plus"></i></a>
              </div>
            </article>
          ';
        }

        echo "<div class='pagination'>";
        if($number_of_pages!=1){
          if($pn!=$number_of_pages){
            echo '<button class="btn btn-primary float-rigth" onclick="request_page('.($pn+1).')">Older posts</button>';
          }
          if($pn>1){
            echo '<button class="btn btn-primary float-left" onclick="request_page('.($pn-1).')">Newer posts</button>';
          }
        }
        echo "</div>";
      }else{
        echo "<span>No se encontraron articulos</span>";
      }
    }
  }else{
    if(isset($_POST["article"])){
      $article_id = $_POST["article"];

      $articles = $consultor -> getItemsBy("articles","id",$article_id);
      $comments_of_article = $consultor -> getTableComplex("comments",["*"],["article_id=$article_id"]);

      if(sizeof($articles)>0){
        foreach($articles as $article){
          $article_date = date($article["date"]);
          $article_tumbnail = explode("/",$article["tumbnail"]);

          echo '
            <article>
              <div class="upper">
                <h1>'.$article["title"].'</h1>
                <div>
                  <span>'.date("h:i A",strtotime($article_date)).'</span>
                  /<span>'.$users_names[$article["user_id"]].'</span>
                  /<span>'.$article["topic"].'</span>
                  /<span>'.$article["likes"].'</span>
                </div>
              </div>
              <div class="lower">
                <p>'.$article["body"].'</p>
              </div>
            </article>
          ';
        }

        $_GET["comments"]=$comments_of_article;
        $_GET["article_id"]=$article_id;

        include "../view/main-page-postComment.view.php";
      }else{
        echo "<span>No se encontro este articulo.</span>";
      }
    }
  }
?>
