$(document).ready(function(){
  request_page(1);
  postWithType("../MainComponents/controller/ProcessUserConfig.xhr.php",{table_name:"mp_config"},function(data){
    let currentData = data.data[0];

    let defaultData = {
      title:"Machu Picchu",
      description:"The largest and most powerful civilization in America",
      ftitle:"Machu Picchu",
      fdescription:"The largest and most powerful civilization in America",
      mainColor:"teal",
      fontColor:"white"
    }

    if(!currentData){
      currentData = defaultData;
    }else{
      Object.keys(currentData).map((attr)=>{
        if(currentData[attr].length==0){
          currentData[attr] = defaultData[attr];
        }
      });
    }

    $("#title_mp").html("<h1>"+currentData.title+"</h1>");
    $("#desc_mp").html(currentData.description);

    $(".mainText_mp").css("color",currentData.fontColor);
    $(".mainTextColor").css("color",currentData.mainColor);

    $("#titlef_mp").html("<h1>"+currentData.ftitle+"</h1>");
    $("#descf_mp").html(currentData.fdescription);
    $(".mainColor_mp").css("background-color",currentData.mainColor);
  },"json");

  get("controller/main-page-populars.xhr.php",function(data){
    let info = JSON.parse(data);
    let currentData = info.data;
    let resultHtml = "";

    for(let element of currentData){
      resultHtml+=`
          <div class="row container">
              <div class="col-xs-3">
                  <img src="../../resources/images/${element.tumbnail}" alt="poparticle">
              </div>
              <div class="col">
                <h3><a href="index.php?article=${element.id}">${element.title}</a></h3>
                <span>${element.likes} x <i class="fa fa-heart"></i></span>
              </div>
          </div>`;
    }

    $("#article_container").html(resultHtml);
  });

  get("../MainComponents/controller/get-topics.xhr.php",function(data){

    let navHtml = "<a class='nav-item nav-link' href='index.php'>Inicio</a>";
    let categoriesHtml = "";

    let info = JSON.parse(data);
    for(var id in info){
      categoriesHtml+=`<li><i class="fa fa-caret-right"></i> <a href="index.php?topic=${info[id]}">${info[id]}</a></li>`;
      navHtml+=`<a class="nav-item nav-link" href="index.php?topic=${info[id]}">${info[id]}</a>`;
    }

    $("#categories").html(categoriesHtml);
    $("#mp_topics").html(navHtml);
  });

  $("#publish_Comment").click(function(e){
    e.preventDefault();
    formValidation(add_comment,"insert","#comment_alert");
  });

  $("#send_mail").click(function(e){
    e.preventDefault();
    if(formValidation(form_contact,"insert")){
      alert("Thanyou for your feedback");
    }else{
      alert("Oops something went wrong.");
    }
    form_contact.reset()
  });

  $(document).on("click",".send_love",function(){
    let article_id = $(this).attr("article_id");
    let element = $(this);
    post("controller/main-page-love.xhr.php",{article_id:article_id},function(data){
      let info = JSON.parse(data);

      if(info.status=="success"){
        alert("Ty for your vote!");
      }

      if(info.already){
        alert("You already voted for this post!");
      }
    });
  });
});

function request_page(pn){

  if(getParameterByName("article")==undefined){
    let dataSend = {
      page:pn
    }

    if(getParameterByName("topic")!=undefined){
      dataSend = {
        ...dataSend,
        topic:getParameterByName("topic")
      }
    }

    post("controller/main-page-articles.xhr.php",dataSend,(data)=>{
      $("#articles").html(data);
      $("#test").dotdotdot({
         ellipsis: "\u2026 "
      });
    });
  }
}
