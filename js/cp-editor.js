window.onload = function(){
  if(getParameterByName("articles")!=undefined){
    richTextArea.document.designMode = "On";
  }
}

var showingSource = false;

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function execComm(command){
  richTextArea.document.execCommand(command,false,null);
}

function execCommWithArg(command,arg){
  richTextArea.document.execCommand(command,false,arg);
}
function toggleSource(){
  if(showingSource){
    richTextArea.document.getElementsByTagName("body")[0].innerHTML = richTextArea.document.getElementsByTagName("body")[0].textContent;
    showingSource=false;
  }else{
    richTextArea.document.getElementsByTagName("body")[0].textContent = richTextArea.document.getElementsByTagName("body")[0].innerHTML;
    showingSource=true;
  }
}
