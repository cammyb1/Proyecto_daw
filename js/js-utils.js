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
   error: function (request, status, error) {
        alert(request.responseText);
    },
   cache: false,
   contentType: false,
   processData: false,
   method: 'POST'
  });
}

function refreshTables(){
  get("controller/refreshTable.php",data=>{});
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

function formValidation(formName,type,divId=null){
  var error = true;
  var failMessage = "";
  var totalElements = formName.elements.length;
  var cont = 0;

  for(var formElement of formName){
    if(formElement.checkValidity()){
      cont++;
    }else{
      failMessage+="<li><b>"+formElement.name+"</b> has an error.</li>"
    }
  }

  if(cont==totalElements){
    error=false;
  }

  if(divId){
    $(divId).removeClass();
    $(divId).html("");
  }


  if(error){
    if(divId){
      $(divId).addClass("alert alert-danger");
      $(divId).html("<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>Error</h4><ul>"+failMessage+"</ul>");
      $("#alert_close").click(()=>closeAlert(divId));
      $(divId).fadeIn(200);
    }
  }else{
    postForm(formName,type,"controller/admincp-postForm.xhr.php",info=>{
      console.log(info);
      let data = JSON.parse(info);
      if(divId){
        $(divId).addClass(data.class);
        $(divId).html("<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>"+data.status+"</h4><ul>"+data.message+"</ul>");
        $("#alert_close").click(()=>closeAlert(divId));
        $(divId).fadeIn(200);
      }
    });
  }

  return !error;
}

function handleStatusAlert(divId,status){

  let currentStatus = status=="success";

  $(divId).removeClass();
  $(divId).html("");

  if(!currentStatus){
    $(divId).addClass("alert alert-danger");
    $(divId).html(`<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>Error</h4> Your request failed.<ul></ul>`);
    $("#alert_close").click(()=>closeAlert(divId));
    $(divId).fadeIn(200);
  }else{
    $(divId).addClass("alert alert-success");
    $(divId).html("<button type='button' class='close' id='alert_close'><span aria-hidden='true'>&times;</span></button><h4 class='alert-heading'>Success</h4><ul><li>Your request was handle successfuly.</li></ul>");
    $("#alert_close").click(()=>closeAlert(divId));
    $(divId).fadeIn(200);
  }
}

function closeAlert(divId){
  $(divId).fadeOut(200);
}
