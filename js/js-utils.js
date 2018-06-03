function get(url,success){
  $.ajax({
   url,
   type:"get",
   success
  });
}
function post(url,data,success){
  $.ajax({
   url,
   type:"post",
   data,
   success
  });
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

function formValidation(formName){
  var clase = "warning"
  var alertMessages = [];
  var error = false;

  $("#alert-box").show("fade");
  $("#alert-list").html("");

  for(element of formName.elements){
    if(element.name!=""){

      switch(element.type){
        case "file":{
          let allowedExt = ["jpg","jpeg","png"]
          let ext = element.value.split(".")[element.value.split(".").length-1].toLowerCase();

          if(element.value.length == 0 || !allowedExt.includes(ext)){
            alertMessages.push(`Element <strong>${element.name}</strong> is missing its value.`);
            error = true;
          }
          break;
        }
        case "text":{
          if(element.value.length == 0 ){
            alertMessages.push(`Element <strong>${element.name}</strong> is missing its value.`);
            error = true;
          }
          break;
        }
      }

      switch(element.tagName){
        case "TEXTAREA":{
          if(element.value=="<br>"){
            alertMessages.push(`Element <strong>${element.name}</strong> is missing its value.`);
            error = true;
          }
          break;
        }
      }
    }
  }

  alertMessages.map(function(item,index){
    $("#alert-list").append(`<li>${item}</li>`)
  });

  if(!error){
    $("#alert-box").removeClass("alert-danger").addClass("alert-success");
    $("#alert-title").html("<strong>Success</strong> article sended.");
  }else{
    $("#alert-box").removeClass("alert-success").addClass("alert-danger");
    $("#alert-title").html("<strong>Oops</strong> Something is missing... <hr />");
  }

  return !error;
}
