<?php
$used_table = $_GET["used_table"];
$name = $_GET["t_name"];
$table_headers = $_GET["table_headers"];

if(sizeof($used_table)<=0){
  echo "<div class='alert alert-warning'>There are no $name yet <i class='far fa-frown'></i></div>";
}

$headers_as_options = ["options"=>"","theads"=>""];
$excluded_values = [
  "options"=>["body","avatar","password"],
  "theads"=>["password"],
  "td_editables"=>["id","date","article_id","user_id"]
];

foreach ($all_headers[strtolower($name)] as $value) {
  $headers_as_options["theads"].="<th>$value</th>";
}

?>

<div class="modal fade" role="dialog" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new <?php echo strtolower(substr($name,0,sizeof($name)-2))?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label  class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control"/>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>
<div>
<table id='downlad_tables' class='table table-dark table-bordered table-hover'>
<thead>
<tr>
  <th colspan='<?php echo (sizeof($all_headers[strtolower($name)])>0?sizeof($all_headers[strtolower($name)])+1:1) ?>' class='search-table'>
    <div>
      <div class='inner-addon left-addon d-flex align-items-center justify-content-between'>
        <div>
          <i class='fa fa-search'></i>
          <input type='text' id='searchBar'/>
        </div>
        <div>
          <a id="dlink"  style="display:none;"></a>
          <a class='btn text-white' onclick="tableToExcel('downlad_tables', '<?php echo $name?> Table', '<?php echo $name?>.xls')"><i class='fa fa-download'></i></a>
          <a class='btn text-white' href=''><i class='fa fa-sync'></i></a>
          <a class='btn text-white' id='table_add' href='<?php echo ($name=="Articles"?"profile.php?articles":"") ?>' data-toggle="modal" data-target="#addModal"><i class='fa fa-plus'></i></a>
        </div>
      </div>
    </div>
  </th>
</tr>
<?php

if(sizeof($headers_as_options["theads"])>0){
  echo "<tr>".$headers_as_options["theads"]."<th>Options</th></tr>";
}

if(sizeof($used_table)>0){
  $max_body_length = 25;
  echo "</thead><tbody id='tabla'>";
  foreach($used_table as $table){
    echo "<tr id='".strtolower($name)."_".$table['id']."'>";
    foreach ($table as $key=>$value) {
      if($key!="password"){
        $elipsis = "";

        if($key=="body"){
          if(strlen($value)>$max_body_length){
            $value = substr(strip_tags($value),0,$max_body_length)."...";
          }
        }
        echo in_array($key,$excluded_values["td_editables"])?"<td><div>$value</div></td>":"<td><div class='table_data' edit_type='click' col_name='$key'>$value</div></td>";
      }
    }
    echo "
      <td class='options'>
          <button class='btn btn-primary edit_table'><i class='fa fa-pencil-alt'></i></button>
          <button class='btn btn-danger save_table'><i class='fa fa-save'></i></button>
          <button class='btn btn-secondary cancel_table'><i class='fa fa-times'></i></button>
          ".(strtolower($name)=="users"&&(($_SESSION["usuario"]->getId()==$table['id'])||($_SESSION["usuario"]->getType()<$table['type']))?"":"<a class='btn btn-danger delete_table' href=''><i class='fa fa-trash'></i></a>")."
      </td>
    </tr>";
  }
}
?>
</tbody></table>
</div>
