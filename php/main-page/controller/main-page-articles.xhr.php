<?php
  include "../model/main-page-articles.model.php";
  session_start();

  if(isset($_POST["page"])){
    $consultor = new Consultor();
    $logger = new Logger();

    $pn = $_POST["page"];
    $topic = array();

    $results_per_page = 2;

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


    $users = $consultor -> getFullTable("users");

    $users_names = array();

    foreach($users as $user){
      $users_names[$user["id"]] = $user["username"];
    }

    $articles = $consultor -> getLimitedTable("articles",$this_page_first_result,$results_per_page,"date",$topic);

    $found = false;

    if(isset($articles)){
      if(sizeof($articles)>0){
        $found = true;
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
                <img src="../../resources/images/'.end($article_tumbnail).'" alt="previewimg">
                <p>'.strip_tags($article["body"]).'</p>
                <div class="share">
                  <span>Share this at</span>
                </div>
              </div>
              <div class="more d-flex justify-content-md-end">
                <a href="index.php?article='.$article["id"].'">+</a>
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

    }
  }
?>
