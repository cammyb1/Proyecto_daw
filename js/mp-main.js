$(document).ready(function(){
  postWithType("../MainComponents/controller/ProcessUserConfig.xhr.php",{table_name:"mp_config"},function(data){
    let currentData = data.data[0];

    let defaultData = {
      title:"Machu Picchu",
      description:"The largest and most powerful civilization in America",
      mainColor:"teal",
      fontColor:"#333"
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

    $("#title_mp").css("color",currentData.fontColor);
    $("#desc_mp").css("color",currentData.fontColor);

    $("#titlef_mp").html("<h1>"+currentData.title+"</h1>");
    $("#descf_mp").html(currentData.description);
    $(".mainColor_mp").css("background-color",currentData.mainColor);
  },"json");

  get("controller/main-page-populars.xhr.php",function(data){
    let info = JSON.parse(data);
    let currentData = info.data;
    let resultHtml = "";

    let articles = Object.keys(currentData);
    for(let article of articles){
      let element = currentData[article];
      resultHtml+=`<div class="article">
              <div>
                  <img src="../../resources/images/${element.tumbnail}" alt="poparticle">
              </div>
              <h3>${element.title}</h3>
              <span>${element.likes}</span>
          </div>
          <div class="article">`;
    }

    $("#article_container").html(resultHtml);
  });

  get("../MainComponents/controller/get-topics.xhr.php",function(data){

    let navHtml = "<a class='nav-item nav-link' href='index.php'>Inicio</a>";
    let categoriesHtml = "";

    let info = JSON.parse(data);
    for(var id in info){
      categoriesHtml+=`<li><span>></span><a href="index.php?topic=${info[id]}">${info[id]}</a></li>`;
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
    formValidation(form_contact,"insert");
    form_contact.reset()
    alert("Thank you for your feedback");
  });

  request_page(1);
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
    });
  }
}
