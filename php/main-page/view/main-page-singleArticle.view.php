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

<article>
  <div class="upper">
    <h1><?php echo $article["title"] ?></h1>
    <div>
      <span><?php echo date("h:i A",strtotime($article_date)) ?></span>
      /<span><?php echo $users_names[$article["user_id"]] ?></span>
      /<span><?php echo $article["topic"] ?></span>
      /<span><?php echo $article["likes"] ?></span>
    </div>
  </div>
  <div class="lower">
    <p><?php echo $article["body"] ?></p>
    <div class="share">
      <span>Share this at</span>
    </div>
  </div>
</article>
<div class='comments'>
  <?php
    foreach($comments as $comment){
      $comment_date = date($comment["date"]);
      $date = date("h:i A",strtotime($article_date));
      ?>
      <div class='single_comment'>
        <div style="background-color:tomato">
          <span>Name :<?php echo $comment["name"]?> Fecha : <?php echo $date?></span>
          <img style="width:50px; height:50px; border-radius:50%;" src="../../Resources/avatars/<?php echo $comment["avatar"]?>" alt="Imagen">
        </div>
        <div>
          <p>Body : <?php echo $comment["body"]?></p>
        </div>
      </div>
      <?php
    }
  ?>
</div>
<div>
  <div id="comment_alert"></div>
  <form name="add_comment">
    <div class="form-group">
      <label for="">Name</label><input type="text" name="name" required>
      <label for="">Body</label><textarea name="body" rows="8" cols="80" maxlength="255" required></textarea>
    </div>
    <input type="hidden" name="table_name" value="comments">
    <input type="hidden" name="article_id" value="<?php echo $article["id"]?>">
    <input class="btn btn-dark" id="publish_Comment" type="submit" value="Publish comment"/>
  </form>
</div>
