<div>
  <?php
    $edit_value=0;
    $current_article=array();

    if(isset($_GET["edit"])){
      $edit_value = $_GET["edit"];
      $tabla_articulo = $_SESSION["tables"]["articles"];
      foreach ($tabla_articulo as $key => $value) {
        if($tabla_articulo[$key]["id"]==$edit_value){
          $current_article = $tabla_articulo[$key];
        }
      }
      $_SESSION["edit"]=$edit_value;
      $_SESSION["modified_article"]=$current_article;
    }

    $_GET["dsb_t"]=sizeof($current_article)>0?"Update post":"Add new post";
    $_GET["dsb_st"]="Posts";
    $_GET["dsb_d"]="Here you can add new article using a rich text editor";

    include "../MainComponents/vista/common-dashboar.view.php";
  ?>

  <div id="alert-box"></div>
  <form class="container" action="" method="POST" enctype="multipart/form-data" name="article_form">
    <div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input class="form-control" placeholder="Title"  type="text" name="title" size="100" maxlength="100" value="<?php echo sizeof($current_article)>0?$current_article["title"]:""?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <select class="custom-select" name="topic" id="topic" required></select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <input type="text" name="tags" id="tags" placeholder="Tags" value="<?php echo sizeof($current_article)>0?$current_article["tags"]:""?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group custom-file">
            <input type="file" class="file" name="tumbnail" id="file" required>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <div class="btn-group">
            <select class="custom-select" onclick="execCommWithArg('fontName',this.value)">
              <option value="Arial">Arial</option>
              <option value="Calibri">Calibri</option>
              <option value="Courier">Courier</option>
              <option value="Tahoma">Tahoma</option>
            </select>
            <button type="button" class="btn btn-default" onclick="execComm('increaseFontSize')"><i class="fas fa-font"></i> <i class="fas fa-angle-double-up"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('decreaseFontSize')"><i class="fas fa-font"></i> <i class="fas fa-angle-double-down"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('bold')"><i class="fas fa-bold"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('underline')"><i class="fas fa-underline"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('italic')"><i class="fas fa-italic"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('strikeThrough')"><i class="fas fa-strikethrough"></i></button>
            <button type="button" class="btn btn-default" onclick="execCommWithArg('formatBlock','h1')"><i class="fas fa-heading"></i></button>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-default" onclick="execComm('removeFormat')"><i class="fas fa-eraser"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('justifyLeft')"><i class="fas fa-align-left"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('justifyCenter')"><i class="fas fa-align-center"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('justifyRight')"><i class="fas fa-align-right"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('justifyFull')"><i class="fas fa-align-justify"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('indent')"><i class="fas fa-indent"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('outdent')"><i class="fas fa-outdent"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('subscript')"><i class="fas fa-subscript"></i></button>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-default" onclick="execComm('superscript')"><i class="fas fa-superscript"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('undo')"><i class="fas fa-undo"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('redo')"><i class="fas fa-redo"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('insertUnorderedList')"><i class="fas fa-list-ul"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('insertOrderedList')"><i class="fas fa-list-ol"></i></button>
            <button type="button" class="btn btn-default" onclick="execCommWithArg('createLink', prompt('Ingresa la ruta'))"><i class="fas fa-link"></i></button>
            <button type="button" class="btn btn-default" onclick="execComm('unlink')"><i class="fas fa-unlink"></i></button>
            <button type="button" class="btn btn-default" onclick="execCommWithArg('insertImage',prompt('Ingresa la ruta de la imagen',''))"><i class="fas fa-image"></i></button>
            <button type="button" class="btn btn-default" onclick="toggleSource()"><i class="fas fa-code"></i></button>
          </div>
        </div>
      </div>
      <div class="form-group">
        <textarea name="body" rows="8" cols="80" maxlength="50000" style="display:none;"></textarea>
        <iframe name="richTextArea" class="editor" src="view/editor_src.php"></iframe>
      </div>
      <input type="hidden" name='user_id' value="<?php echo sizeof($current_article)>0?$current_article["user_id"]:$_SESSION["usuario"]->getId()?>">
      <input type="hidden" name='table_name' value='articles'>
      <?php
        echo sizeof($current_article)>0?"<input type='hidden' name='elem_id' value='".$current_article['id']."' />":"";
      ?>
    </div>
    <div>
      <?php
        if(sizeof($current_article)>0){
          echo "<button class='btn up_button' id='a_update' >Update article</button>";
        }else{
          echo "<button class='btn up_button' id='a_send' >Upload article</button>";
        }
      ?>
    </div>
  </form>

</div>
