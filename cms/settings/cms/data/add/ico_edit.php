<?php
$do = $_POST['do'];
if($do=="add"){
    if($_FILES['add_ik']['name']!=NULL){
    $path = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file'];
    $icon = $_FILES['add_ik']['name'];
    $roz = substr($icon, strpos($icon, ".")+1);
    move_uploaded_file($_FILES['add_ik']['tmp_name'], $path.'/'.$icon);
    rename($path.'/'.$icon, $path."/icon.".$roz);
    }else{
        echo "błąd - nie wybrano pliku";
    };
};
if($do=="del"){
    $str = scandir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']);
    for($i = 2; $i < count($str); $i++){
        if(str_contains($str[$i], 'icon')){
            $roz = substr($str[$i], strpos($str[$i], ".")+1);
            $plik = "icon.".$roz;
            unlink($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file'].'/'.$plik);
        };
    };
};
if($do == "chc"){
    $str = scandir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']);
    for($i = 2; $i < count($str); $i++){
        if(str_contains($str[$i], 'icon')){
            $roz = substr($str[$i], strpos($str[$i], ".")+1);
            $plik = "icon.".$roz;
            unlink($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file'].'/'.$plik);
        };
    };
    if($_FILES['edit_ik']['name']!=NULL){
        $path = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file'];
        $icon = $_FILES['edit_ik']['name'];
        $roz = substr($icon, strpos($icon, ".")+1);
        move_uploaded_file($_FILES['edit_ik']['tmp_name'], $path.'/'.$icon);
        rename($path.'/'.$icon, $path."/icon.".$roz);
        }else{
            echo "błąd - nie wybrano pliku";
        }; 
};
?>