$(document).ready(function(){
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

      $("#add_alert").removeClass();
      $("#add_alert").html("");
      $("#add_alert").fadeOut();
    }
  });

  $("#add_element").click(function(){
    $("#add_alert").removeClass();
    $("#add_alert").html("");

    postForm(add_form,"controller/admincp-postForm.xhr.php",info=>{
      $("#add_alert").addClass(info.class);
      $("#add_alert").html(info.message);
      $("#add_alert").fadeIn(200);
    });
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

  	$.extend(arr, {row_id:row_id});

    post("model/admincp-updatetable.xhr.php",arr,function(data){});
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

  	tbl_row.find('.save_table').hide();
  	tbl_row.find('.cancel_table').hide();

  	tbl_row.find('.edit_table').show();
  	tbl_row.find('.delete_table').show();

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

  	tbl_row.find('.save_table').hide();
  	tbl_row.find('.cancel_table').hide();

    tbl_row.find('.edit_table').show();
    tbl_row.find('.delete_table').show();


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

  	$.extend(arr, {row_id:row_id});

    post("model/admincp-updatetable.xhr.php",arr,function(data){});
  });

  $(".delete_table").click(function(){
    var tbl_row = $(this).closest('tr');
    var row_id = tbl_row.attr('id');

    post("model/admincp-deletefromtable.xhr.php",{row_id:row_id},function(data){console.log(data)});
  });

});

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
