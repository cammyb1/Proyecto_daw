$(document).ready(function () {
    if(getParameterByName("articles")!=undefined){
      richTextArea.document.designMode = "On";
    }

    $("#alert-close").click(function(){
      $("#alert-box").hide("fade");
    });

    $("#a_send").click(submitForm);

    get("model/admincp-tags.xhr.php",function(data){
      $("#tags").tokenfield({
        autocomplete:{
          source:JSON.parse(data),
          delay:100
        },
        showAutocompleteOnFocus:true
      });
    });

    get("model/admincp-topics.xhr.php",function(data){
      let info = JSON.parse(data);
      for(var i=0;i<info.length;i++){
        $("#topic").append("<option value="+info[i]+">"+info[i]+"</option>");
      }
    });

 });



 var showingSource = false;

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

 function submitForm(){
   article_form.body.innerHTML = richTextArea.document.getElementsByTagName("body")[0].innerHTML;
    if(formValidation(article_form)){
      article_form.submit();
    }
 }
