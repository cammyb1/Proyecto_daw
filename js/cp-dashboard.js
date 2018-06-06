$(document).ready(function(){

  setInterval(function(){
    setTime();
    get("model/admincp-visitors.xhr.php",data => $("#visitors").html(data));
  },1000);

  $("#mvc_refresh").click(function(){
    callCountries();
  });
  $("#tm_refresh").click(function(){
    callTables();
  });

  setTime();
  callTables();
  callCountries();
});

function callTables(){
  get("model/admincp-tables.xhr.php",(data)=>{
    let result = JSON.parse(data);
    if(result.length>0){
      var chart = new CanvasJS.Chart("table-metrics", {
        animationEnabled: true,
        theme: "light2",
        data: [{
          type: "column",
          indexLabelFontColor: "#5A5757",
          indexLabelPlacement: "outside",
          dataPoints:result
        }]
      });
      chart.render();
    }else{
      $("#table-metrics").html("<div class='alert alert-warning'>There is no tables records.</div>");
    }
  });

  $("#bar-toggle").click(function(){
    $("#left-navbar").toggleClass("hide-nav");
    $("#content").toggleClass("push");
  });
}



function setTime(){
  var options = {
    hour:'2-digit',
    minute:'2-digit',
    second:'2-digit'
  };
  var date = new Date();
  $("#ct-db").html("<b>"+date.toLocaleString("es-ES",options)+"</b>")
}
function callCountries(){
  get("model/admincp-country.xhr.php",(data)=>{
    let result = JSON.parse(data);
    if(result.length>0){
      var chart = new CanvasJS.Chart("most_visited_c", {
        animationEnabled: true,
        theme: "light2",
        data: [{
          type: "pie",
          yValueFormatString: "#,##0.00\"%\"",
          indexLabel: "{label} ({y})",
          dataPoints: result
        }]
      });
      chart.render();
    }else{
      $("#most_visited_c").html("<div class='alert alert-warning'>There is no country records.</div>");
    }
  });
}
