$(document).ready(function(){

  request_page(1);

  get("model/guest_users-xhr.model.php",(data)=>data);
});

function request_page(pn){
  postWithType("controller/main-page-articles.xhr.php","page="+pn,(data)=>{
    $("#articles").html(data);
  },"json");
}
