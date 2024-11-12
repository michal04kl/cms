<?php
$con = $_POST['connect'];
if($con == "link"){
    $sprstr = file_get_contents($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php");
    if(str_contains($sprstr, $_POST['id'])){
        echo "błąd - strona już jest podlinkowana";
        return false;
    };
    $x = $_POST['wid'];
    if($x==NULL){
        echo "błąd - nie ustawiono metryk";
        return false;
    };
    $id = $_POST['id'];
    $sp = '"/settings/cms/data/pages/'.$id.'"';
    echo "
<div class='reference col-lg-".$x."' id='".$id."' onclick='document.location.replace(".$sp.")'>";
if(str_contains($id, "at_")){
    $icosrc = scandir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$id");
    $roz = 0;
    for($i = 2; $i < count($icosrc) ; $i++){
        if(str_contains($icosrc[$i], 'icon')){
            $roz = substr($icosrc[$i], strpos($icosrc[$i], ".")+1);
        };
    };
    if($roz != 0){
        echo "<img src='/settings/cms/data/pages/".$id."/icon.".$roz."'>";
    }else{
        echo "<iframe src='/settings/cms/data/pages/".$id."/index.php'></iframe>";
    };
}else{
echo "<iframe src='/settings/cms/data/pages/".$id."'></iframe>";
};
echo "<h1>".$_POST['name']."</h1></div>
";    
};
if($con == "unlink"){
$id = $_POST['id'];
$sprstr = file($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php");
$str = file_get_contents($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php");
for($i = 0; $i<count($sprstr); $i++){
    if(str_contains($sprstr[$i], $id)){
        $str = str_replace($sprstr[$i], '', $str);
        $strona = fopen($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php", "w") or die("Unable to open file!");
        fwrite($strona, $str);
        fclose($strona);
        echo "rozłączono ".$_POST['name'];
        return false;
    };
};
};
?>