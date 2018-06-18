<?php
  $comments=array();
  $article=array();
  $users_names=array();

  if(isset($_GET["comments"])){
    $comments = $_GET["comments"];
  }

  if(isset($_GET["article"])){
    $article = $_GET["article"][0];
    $article_date = date($article["date"]);
  }

  if(isset($_GET["usernames"])){
    $users_names = $_GET["usernames"];
  }
?>

<article class='single_article'>
  <div class="upper">
    <h1><?php echo $article["title"] ?></h1>
    <div>
      <span><i class="far fa-calendar-alt"></i> <?php echo date("d/m/Y",strtotime($article_date)) ?></span>
      -<span><i class="fa fa-user"></i> <?php echo $users_names[$article["user_id"]] ?></span>
      -<span><i class="fa fa-list-alt"></i> <?php echo $article["topic"] ?></span>
      -<span><i class="fa fa-heart"></i> <?php echo $article["likes"] ?></span>
    </div>
  </div>
  <div class="lower">
    <p><?php echo $article["body"] ?></p>
    <a class=''></a>
  </div>
</article>
<div class='comments'>
  <?php
    if(sizeof($comments)>0){
      foreach($comments as $comment){
        $comment_date = date($comment["date"]);
        $date = date("d/m/y h:i A",strtotime($comment_date));
        ?>
        <div class='single_comment d-flex align-items-center'>
          <img src="../../resources/avatars/<?php echo $comment["avatar"]?>" alt="Imagen">
          <div class="body">
            <span><i class="fa fa-user"></i> <?php echo $comment["name"]?>  - <i class="far fa-calendar-alt"></i> <?php echo $date?></span>
            <p><?php echo strip_tags($comment["body"])?></p>
          </div>
        </div>
        <?php
      }
    }else{
      echo "
        <div class='alert alert-warning'>There are no comments yet <i class='far fa-frown'></i></div>
      ";
    }
  ?>
</div>
<div>
  <div id="comment_alert"></div>
  <form name="add_comment">
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <input class="form-control" type="text" name="name" placeholder="Name" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <textarea class="form-control" name="body"maxlength="255" required placeholder="Leave a message.."></textarea>
        </div>
      </div>
    </div>
    <input type="hidden" name="table_name" value="comments">
    <input type="hidden" name="article_id" value="<?php echo $article["id"]?>">
    <input class="btn btn-primary" id="publish_Comment" type="submit" value="Publish comment"/>
  </form>
</div>
