$(document).ready(function(){

});

postWithType("../MainComponents/controller/ProcessUserConfig.xhr.php",{table_name:"lp_config"},function(data){
  let currentData = data.data[0];
  let defaultData = {
    blackcoat:"1",
    title:"Machu Picchu",
    description:"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt sint, nobis iusto facere reprehenderit rerum fugiat quae.",
    bg_landing:"machu-picchu.jpg"
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

  currentData.blackcoat==1?$("#coat").show():$("#coat").hide();
  $("#landing").css("background","url('../../resources/images/"+currentData.bg_landing+"')");
  $("#landing").css("background-repeat","no-repeat");
  $("#landing").css("background-attachment","fixed");
  $("#landing").css("background-size","cover");
  $("#landing").css("background-position","center");
  $("#l-title").html("<h1>"+currentData.title+"</h1>");
  $("#l-desc").html(currentData.description);
  $("#content_lp").fadeIn(200);
},"json");
