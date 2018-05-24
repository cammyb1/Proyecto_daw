<div>
  <form action="POST">
    <label for="">Title</label><br>
    <input type="text" name="a_title" size="100"><br><br>
    <div>
      <div class="btn-group">
        <select class="custom-select" name="a_font" onclick="execCommWithArg('fontName',this.value)">
          <option value="Arial">Arial</option>
          <option value="Calibri">Calibri</option>
          <option value="Courier">Courier</option>
          <option value="Tahoma">Tahoma</option>
        </select>
        <button type="button" class="btn btn-primary" onclick="execComm('increaseFontSize')"><i class="fas fa-font"></i> <i class="fas fa-angle-double-up"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('decreaseFontSize')"><i class="fas fa-font"></i> <i class="fas fa-angle-double-down"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('bold')"><i class="fas fa-bold"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('underline')"><i class="fas fa-underline"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('italic')"><i class="fas fa-italic"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('strikeThrough')"><i class="fas fa-strikethrough"></i></button>
        <button type="button" class="btn btn-primary" onclick="execCommWithArg('formatBlock','h1')"><i class="fas fa-heading"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('removeFormat')"><i class="fas fa-eraser"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('justifyLeft')"><i class="fas fa-align-left"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('justifyCenter')"><i class="fas fa-align-center"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('justifyRight')"><i class="fas fa-align-right"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('justifyFull')"><i class="fas fa-align-justify"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('indent')"><i class="fas fa-indent"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('outdent')"><i class="fas fa-outdent"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('subscript')"><i class="fas fa-subscript"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('superscript')"><i class="fas fa-superscript"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('undo')"><i class="fas fa-undo"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('redo')"><i class="fas fa-redo"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('insertUnorderedList')"><i class="fas fa-list-ul"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('insertOrderedList')"><i class="fas fa-list-ol"></i></button>
        <button type="button" class="btn btn-primary" onclick="execCommWithArg('createLink', prompt('Ingresa la ruta'))"><i class="fas fa-link"></i></button>
        <button type="button" class="btn btn-primary" onclick="execComm('unlink')"><i class="fas fa-unlink"></i></button>
        <button type="button" class="btn btn-primary" onclick="execCommWithArg('insertImage',prompt('Ingresa la ruta de la imagen',''))"><i class="fas fa-image"></i></button>
        <button type="button" class="btn btn-primary" onclick="toggleSource()"><i class="fas fa-code"></i></button>

      </div>
      <div>
        <textarea name="body" rows="8" cols="80" maxlength="5000" style="display:none;"></textarea>
        <iframe name="richTextArea" style="width:1000px; height:500px; background-color: #fff;"></iframe>
      </div>
    </div>

  </form>

</div>
