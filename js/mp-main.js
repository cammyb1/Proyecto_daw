$(document).ready(function(){

  request_page(1);

  get("model/guest_users-xhr.model.php",(data)=>data);
});

function request_page(pn){
  postJSON("model/main-page-articles.xhr.php","page="+pn,(data)=>{
    $("#articles").html(data);
  });
}
