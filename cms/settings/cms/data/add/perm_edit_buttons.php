<div id="at_buttons_chc" style="display:flex; width:100%; flex-wrap: wrap; height:100%; flex-direction: row; align-content: center; justify-content: space-around; align-items: baseline;">
<?php
$old = $_POST['old'];
$all = scandir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$old");
if(is_dir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$old/liblary")){
    $op_lib = 1;
for($i = 2; $i < count($all); $i++){
  if(str_contains($all[$i], "icon")){
    $op_ico = 1;
    decidet($op_lib, $op_ico, $old);
    return false;
  };  
};
$op_ico = 2;
decidet($op_lib, $op_ico, $old);
}else{
    $op_lib = 2;
    for($i = 2; $i < count($all); $i++){
        if(str_contains($all[$i], "icon")){
          $op_ico = 1;
          decidet($op_lib, $op_ico, $old);
          return false;
        };  
      };
      $op_ico = 2;
      decidet($op_lib, $op_ico, $old);
};
function decidet($lib, $ico, $file){ ?>
<div style="display:flex; align-items: center; flex-direction: column;">
<?php
if($lib == 1){
    echo "<h1>Biblioteka</h1><div style='display:flex; justify-content: space-around; flex-direction: row;' ><button id='edit_lib'>Edytuj</button><button id='del_lib'>Usuń</button></div>";
}else{
    echo "<h1>Biblioteka</h1><form id='add_lib_f' enctype='multipart/form-data'><label for='add_lib_i'>Wybierz plik (*.zip)</label>&nbsp;<input type='file' name='add_lib_i' id='add_lib_i' accept='.zip' require><button id='add_lib'>Dodaj</button></form>";
};
?> 
</div>
<div style="display:flex; align-items: center; flex-direction: column;">
<?php
if($ico == 1){
    echo "<h1>Ikona</h1><div style='display:flex; flex-wrap: nowrap; justify-content: space-evenly; flex-direction: row;'><form id='edit_ik_f' enctype='multipart/form-data'><label for='edit_ik'>Wybierz obraz</label>&nbsp;<input type='file' name='edit_ik' id='edit_ik' accept='image/*' require><button id='change_ik_but'>Zmień</button></form>&nbsp;<button id='del_ik'>Usuń</button></div>";
}else{
    echo "<h1>Ikona</h1><form id='add_ik_f' enctype='multipart/form-data'><label for='add_ik'>Wybierz obraz</label>&nbsp;<input type='file' name='add_ik' id='add_ik' accept='image/*' require><button id='add_ik_but'>Dodaj</button></form>";
};
};
?>
</div>
</div>