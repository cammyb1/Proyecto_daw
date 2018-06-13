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
    $(".mainColor_mp").css("background-color",currentData.mainColor);
  },"json");
  
  get("../MainComponents/controller/get-topics.xhr.php",function(data){

    let resultHtml = "<a class='nav-item nav-link' href='index.php'>Inicio</a>";

    let info = JSON.parse(data);
    for(var id in info){
      resultHtml+=`<a class="nav-item nav-link" href="index.php?topic=${info[id]}">${info[id]}</a>`;
    }

    $("#mp_topics").html(resultHtml);
  });

  request_page(1);
});

function request_page(pn){
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
