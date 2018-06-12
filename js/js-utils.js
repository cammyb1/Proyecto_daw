function get(url,success){
  $.ajax({
   url,
   type:"get",
   method: 'GET',
   success
  });
}
function post(url,data,success){
  $.ajax({
   url,
   type:"post",
   method: 'POST',
   data,
   success
  });
}
function postWithType(url,data,success,dataType){
  $.ajax({
   url,
   type:"post",
   method: 'POST',
   data,
   dataType,
   encode:true,
   success
  });
}

function sendPostForm(url,data,success){
  $.ajax({
   url,
   type:"post",
   data,
   success,
   cache: false,
   contentType: false,
   processData: false,
   method: 'POST'
  });
}

function postForm(formElement,url,success){
  let elements = formElement.elements;
  let excluded_tags = ["INPUT","TEXTAREA","SELECT"]
  let formData = new FormData();

  for(var id in elements){
    let currentElement = elements[id];

    if(excluded_tags.includes(currentElement.tagName)){
      if(currentElement.type!="file"){
        formData.append(currentElement.name,currentElement.value);
      }else{
        jQuery.each(jQuery("#file")[0].files, function(i, file) {
            formData.append(currentElement.name, file);
        });
      }
    }
  }

  sendPostForm(url,formData,success);
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function formValidation(formName,divId){
  var error = false;
  $(divId).removeClass();
  $(divId).html("");
  var mailREGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  for(element of formName.elements){
    if(element.name!=""){
      switch(element.type){
        case "file":{
          let allowedExt = ["jpg","jpeg","png"]
          let ext = element.value.split(".")[element.value.split(".").length-1].toLowerCase();

          if(element.value.length == 0 || !allowedExt.includes(ext)){
            error = true;
          }
          break;
        }
        case "text":{
          if(element.value.length == 0 ){
            error = true;
          }
          break;
        }
        case "email":{
          if(!mailREGEX.test(element.value)){
            error = true;
          }
          break;
        }
      }

      switch(element.tagName){
        case "TEXTAREA":{
          if(element.value=="<br>"||element.value==""){
            error = true;
          }
          break;
        }
      }
    }
  }

  if(error){
    $(divId).addClass("alert alert-danger");
    $(divId).html("<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>Error</h4><ul><li>Something went wrong..</li></ul>");
    $("#alert_close").click(()=>closeAlert(divId));
    $(divId).fadeIn(200);
  }else{
    postForm(formName,"controller/admincp-postForm.xhr.php",info=>{
      let data = JSON.parse(info);
      $(divId).addClass(data.class);
      $(divId).html("<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>"+data.status+"</h4><ul>"+data.message+"</ul>");
      $("#alert_close").click(()=>closeAlert(divId));
      $(divId).fadeIn(200);
    });
  }

  return !error;
}

function closeAlert(divId){
  $(divId).fadeOut(200);
}
