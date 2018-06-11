$(document).ready(function(){
    postWithType("../MainComponents/controller/ProcessUserConfig.xhr.php",{table_name:"lp_config"},function(data){
      let currentData = data.data[0];
      console.log(currentData);
      currentData.blackcoat==1?$("#coat").show():$("#coat").hide();
      $("#l-bg").attr("src","../../resources/"+currentData.bg_landing);
      $("#l-title").html("<h1>"+currentData.title+"</h1>");
      $("#l-desc").html(currentData.description);
    },"json");
});
