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
  "td_editables"=>["id","date","body","tumbnail","avatar"]
];
$value_types = [
  "numeric"=>["article_id","active"],
  "select"=>["type"],
  "text_area"=>["body"]
];
$numeric_values = [
  "active"=>["min"=>0,"max"=>1]
];

foreach ($all_headers[strtolower($name)] as $value) {
  $headers_as_options["theads"].="<th>$value</th>";
}

?>
<div class="modal fade" role="dialog" id="alertModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="alertbox_d"></div>
    </div>
  </div>
</div>
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
        <div class="" role="alert" id="add_alert" style="display:none;"></div>
        <form class="form-horizontal" name="add_form" id="form_add" role="form">
          <?php
            foreach($all_headers[strtolower($name)] as $value){
              if(!in_array($value,$excluded_values["td_editables"])){
                echo "<div class='form-group'>
                  <label  class='col-sm-2 control-label'>".ucfirst($value)."*</label>
                  <div class='col-sm-12'>";
                  if(in_array($value,$value_types["numeric"])){
                    $min = isset($numeric_values[$value]["min"])?$numeric_values[$value]["min"]:1;
                    $max = isset($numeric_values[$value]["max"])?$numeric_values[$value]["max"]:-1;
                    echo "<input type='number' name='".ucfirst($value)."' class='form-control' value='$min' ".($min>=0?"min=$min":"")." ".($max>=0?"max=$max":"")." />";
                  }else if(in_array($value,$value_types["select"])){
                    //THIS SHOULD BE MORE INTELIGENT!
                    echo "<select name='".ucfirst($value)."' class='form-control'>
                      ".($_SESSION["usuario"]->getType()==1?"<option value=1>Web Master</option>":"")."
                      <option value=2>Moderator</option>
                    </select>";
                  }else if(in_array($value,$value_types["text_area"])){
                    echo "<textarea name='".ucfirst($value)."' maxlength=255 class='form-control area-modal' resizable='false'></textarea>";
                  }else{
                    if($value=="email"){
                      echo "<input type='email' name='".ucfirst($value)."' class='form-control'/>";
                    }else{
                      echo "<input type='text' name='".ucfirst($value)."' class='form-control'/>";
                    }
                  }
                echo "</div></div>";
              }
            }
            echo "<input type='hidden' name='table_name' value='".strtolower($name)."'/>";
          ?>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="add_element">Add</button>
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
          <?php
            if($name=="Articles"){
             echo "<a class='btn text-white' id='table_add' href='profile.php?articles'><i class='fa fa-plus'></i></a>";
           }else{
             echo "<a class='btn text-white' id='table_add' href='' data-toggle='modal' data-target='#addModal'><i class='fa fa-plus'></i></a>";
           }
          ?>
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

        $value = strip_tags($value);

        if(strlen($value)>$max_body_length){
          $value = substr($value,0,$max_body_length)."...";
        }
        echo in_array($key,$excluded_values["td_editables"])?"<td><div>$value</div></td>":"<td><div class='table_data' edit_type='click' col_name='$key'>$value</div></td>";
      }
    }
    echo "
      <td class='options'>";
          echo $name!="Articles"?"<button class='btn btn-primary edit_table'><i class='fa fa-pencil-alt'></i></button>":"<a class='btn btn-primary' href='profile.php?articles&edit=".$table['id']."'><i class='fa fa-pencil-alt'></i></a>";
          echo "<button class='btn btn-danger save_table'><i class='fa fa-save'></i></button>
          <button class='btn btn-secondary cancel_table'><i class='fa fa-times'></i></button>
          ".(strtolower($name)=="users"&&(($_SESSION["usuario"]->getId()==$table['id'])||($_SESSION["usuario"]->getType()<$table['type']))?"":"<a class='btn btn-danger delete_table' href='' data-toggle='modal' data-target='#alertModal'><i class='fa fa-trash'></i></a>")."
      </td>
    </tr>";
  }
}
?>
</tbody></table>
</div>
