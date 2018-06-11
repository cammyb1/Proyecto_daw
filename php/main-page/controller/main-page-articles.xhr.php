<?php
  require_once("../../MainComponents/modelo/Components/Logger.php");
  require_once("../../MainComponents/modelo/Components/User.php");
  require_once("../../MainComponents/modelo/Consultor.php");
  session_start();

  if(isset($_POST["page"])){
    $consultor = new Consultor();

    $pn = $_POST["page"];

    $results_per_page = 10;
    $number_of_results = $consultor -> getTableSize("articles");
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

    $articles = $consultor -> getLimitedTable("articles",$this_page_first_result,$results_per_page,"date");

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
                  <span>'.date("h:i A",strtotime($article_date)).'</span>
                  /<span>'.$users_names[$article["user_id"]].'</span>
                  /<span>'.$article["topic"].'</span>
                  /<span>'.$article["likes"].'</span>
                </div>
              </div>
              <div class="lower">
                <img src="../../resources/tumbnails/'.$article["tumbnail"].'" alt="previewimg">
                <p>'.strip_tags($article["body"]).'</p>
                <div class="share">
                  <span>Share this at</span>
                </div>
              </div>
              <div class="more">
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
  }
?>
