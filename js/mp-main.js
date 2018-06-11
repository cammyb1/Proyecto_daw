$(document).ready(function(){

  request_page(1);
});

function request_page(pn){
  post("controller/main-page-articles.xhr.php","page="+pn,(data)=>{
    $("#articles").html(data);
  },"json");
}
