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

function postForm(formElement,type,url,success){
  let elements = formElement.elements;
  let excluded_tags = ["INPUT","TEXTAREA","SELECT"]
  let formData = new FormData();

  for(var id in elements){
    let currentElement = elements[id];

    if(excluded_tags.includes(currentElement.tagName)){
      if(currentElement.type!="file"){
        if(currentElement.type!="checkbox"){
          formData.append(currentElement.name,currentElement.value);
        }else{
          formData.append(currentElement.name,currentElement.checked?1:0);
        }
      }else{
        jQuery.each(jQuery("#file")[0].files, function(i, file) {
            formData.append(currentElement.name, file);
        });
      }

      formData.append("type",type);
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

function formValidation(formName,type,divId){
  var error = true;
  $(divId).removeClass();
  $(divId).html("");

  if(formName.checkValidity()){
    error=false;
    console.log(formName.checkValidity());
  }


  if(error){
    $(divId).addClass("alert alert-danger");
    $(divId).html("<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>Error</h4><ul><li>Something went wrong..</li></ul>");
    $("#alert_close").click(()=>closeAlert(divId));
    $(divId).fadeIn(200);
  }else{
    postForm(formName,type,"controller/admincp-postForm.xhr.php",info=>{
      console.log(info);
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
