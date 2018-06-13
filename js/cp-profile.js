$(document).ready(function(){

  getEmails();

  $("#searchBar").keyup(function() {
    var value = $(this).val().toLowerCase();
    $("#tabla tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $(".cancel_table").hide();
  $(".save_table").hide();

  $('.customCollapse').on('shown.bs.collapse', function () {
      $(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");
      $(this).parent().find(".nav-item").addClass("nav-active");
   });
   $('.customCollapse').on('hide.bs.collapse', function () {
     $(this).parent().find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");
     $(this).parent().find(".nav-item").removeClass("nav-active");
  });

  $("#table_add").click(function(e){
    if($(this).attr("href")==""){
      e.preventDefault();
    }
  });

  $("#add_element").click(function(){
    formValidation(add_form,"insert","#add_alert");
  });

  $("#send_mp").click(function(){
    formValidation(mp_form,"update","#alert_mp")
  });

  $("#send_lp").click(function(){
    formValidation(lp_form,"update","#alert_lp")
  });

  $("#tabla .table_data").click(function(){
    if($(this).attr('edit_type') == 'button'){
  		return false;
  	}

    $(this).attr("contenteditable","true");
    $(this).addClass("bg-light");
    $(this).addClass("text-dark");
    $(this).focus();
  });

  $("#tabla .table_data").focusout(function(){
    if($(this).attr('edit_type') == 'button'){
  		return false;
  	}

    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('id');

    $(this).attr("contenteditable","false");
    $(this).removeClass("bg-light");
    $(this).removeClass("text-dark");

    var col_name = $(this).attr('col_name');
  	var col_val = $(this).html();

  	var arr = {};
  	arr[col_name] = col_val;

  	arr = {
      ...arr,
      row_id
    }

    postWithType("controller/admincp-updatetable.xhr.php",arr,function(data){},"json");
  });

  $(".edit_table").click(function(){

    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('id');

    tbl_row.find('.cancel_table').show();
    tbl_row.find('.save_table').show();

    tbl_row.find('.edit_table').hide();
    tbl_row.find('.delete_table').hide();

    tbl_row.find('.table_data')
    .attr('contenteditable', 'true')
    .attr('edit_type', 'button')
    .addClass("bg-light")
    .addClass("text-dark")

    tbl_row.find('.table_data').each(function(index, val)
    {
      $(this).attr('original_entry', $(this).html());
    });
  });



  $(".cancel_table").click(function(){
    var tbl_row = $(this).closest('tr');
  	var row_id = tbl_row.attr('id');

  	tbl_row.find('.save_table').fadeOut(100);
  	tbl_row.find('.cancel_table').fadeOut(100);

  	tbl_row.find('.edit_table').fadeIn(100);
  	tbl_row.find('.delete_table').fadeIn(100);

  	tbl_row.find('.table_data')
    .attr('edit_type', 'click')
  	.removeAttr('contenteditable')
    .removeClass("bg-light")
    .removeClass("text-dark")

  	tbl_row.find('.table_data').each(function(index, val)
  	{
  		$(this).html( $(this).attr('original_entry') );
  	});
  });


  $(".save_table").click(function(){

    var tbl_row = $(this).closest('tr');
    var row_id = tbl_row.attr('id');

  	tbl_row.find('.save_table').fadeOut(100);
  	tbl_row.find('.cancel_table').fadeOut(100);

    tbl_row.find('.edit_table').fadeIn(100);
    tbl_row.find('.delete_table').fadeIn(100);


  	tbl_row.find('.table_data')
    .attr('edit_type', 'click')
  	.removeAttr('contenteditable')
    .removeClass("bg-light")
    .removeClass("text-dark")

  	var arr = {};
  	tbl_row.find('.table_data').each(function(index, val)
  	{
  		var col_name = $(this).attr('col_name');
  		var col_val  =  $(this).html();
  		arr[col_name] = col_val;
  	});

  	arr = {
      ...arr,
      row_id
    }

    postWithType("controller/admincp-updatetable.xhr.php",arr,function(data){
      let status = data.status;
      handleStatusAlert("#tableAlert",status);
    },"json");
  });

  $(".delete_table").click(function(e){
    e.preventDefault();
    var tbl_row = $(this).closest('tr');
    var row_id = tbl_row.attr('id');

    if(confirm("Are you sure you want to do this?.")){
      postWithType("controller/admincp-deletefromtable.xhr.php",{row_id:row_id},function(data){
        let status = data.status;
        handleStatusAlert("#tableAlert",status);
      },"json");
    }
  });

  $("#refresh_mails").click((data)=>{
    getEmails();
  });

  postWithType("../MainComponents/controller/ProcessUserConfig.xhr.php",{table_name:"lp_config"},data=>{
    let form = lp_form;
    let currentData = data.data[0];
    for(var formElement of form){
      if(currentData[formElement.name]){
         handleCustomDataType(formElement,currentData);
      }
    }
  },"json");

  postWithType("../MainComponents/controller/ProcessUserConfig.xhr.php",{table_name:"mp_config"},data=>{
    let form = mp_form;
    let currentData = data.data[0];
    for(var formElement of form){
      if(currentData[formElement.name]){
         handleCustomDataType(formElement,currentData);
      }
    }
  },"json");




});


function handleCustomDataType(formElement,currentData){
  switch(formElement.tagName){
    case "INPUT":{
      switch(formElement.type){
        case "checkbox":{
          $(formElement).attr("checked",currentData[formElement.name]==1?true:false);
          break;
        }
        case "file":{
          break;
        }
         default:{
           $(formElement).attr("value",currentData[formElement.name]);
           break;
         }
      }
      break;
    }
    case "TEXTAREA":{
      $(formElement).html(currentData[formElement.name]);
    }
  }
}

function setWatched(e){
  let isWatched = $(e).attr("isWatched")=="true";
  let row_id = $(e).attr("row_id");

  if(!isWatched){
  	arr = {
      watched:1,
      row_id
    }
    postWithType("controller/admincp-updatetable.xhr.php",arr,function(data){},"json");

    getEmails();
  }
}

function deleteMail(e){
  let row_id = $(e).attr("row_id");

  postWithType("controller/admincp-deletefromtable.xhr.php",{row_id:row_id},function(data){},"json");
  getEmails();
}

function getEmails(){
  get("controller/admincp-mails.xhr.php",(data)=>{
    let currentData = JSON.parse(data);
    if(currentData.data.length>0){
      let fullMails ="";
      let cont = 0;
      for(let email of currentData.data){
        cont++;
        fullMails+=`
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between cleafix ${email.watched==0?"":"main-color"}">
            <a class="text-white" data-toggle="collapse" href="#mail_collapse${cont}"><span><b>From</b> ${email.name}</span> / <span><b>Subject</b> ${email.subject}</span> / <span><i class='fa fa-at'></i> ${email.email}</span></a>
            <div>
              <a class='btn text-white m_watched' onclick="setWatched(this)" isWatched='${email.watched==0?false:true}' row_id='${"mail_box-"+email.id}'><i class='${email.watched==0?"far fa-eye-slash":"far fa-eye"}'></i></a>
              <a class='btn text-white m_watched' onclick="deleteMail(this)" row_id='${"mail_box-"+email.id}'><i class='fa fa-trash'></i></a>
            </div>
          </div>
          <div id="mail_collapse${cont}" class="panel-collapse collapse">
            <div class="card-body">${email.message}</div>
          </div>
        </div>
        `;
      }

      $("#mail-content").html(fullMails).hide().fadeIn(200);
    }else{
      $("#mail-content").html("<div><p>Nothing to show here!</p></div>");
    }
  });
}

var tableToExcel = (function () {
  var uri = 'data:application/vnd.ms-excel;base64,',
      template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
      base64 = function (s) {
          return window.btoa(unescape(encodeURIComponent(s)))
      }, format = function (s, c) {
          return s.replace(/{(\w+)}/g, function (m, p) {
              return c[p];
          })
      }
  return function (table, name, filename) {
      if (!table.nodeType) table = document.getElementById(table)
      var ctx = {
          worksheet: name || 'Worksheet',
          table: table.innerHTML
      }
     document.getElementById("dlink").href = uri + base64(format(template, ctx));
     document.getElementById("dlink").download = filename;
     document.getElementById("dlink").click();
  }
})()
