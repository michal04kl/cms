<?php
$todel = $_POST['strona'];
foreach($todel as $del){
    $path = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$del";
    system("rm -rf ".escapeshellarg($path));
    system('rmdir '.escapeshellarg($path).' /s /q');
    $show = file_get_contents($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php");
    if(str_contains($show, $del)){
        $sprstr = file($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php");
        for($i = 0; $i<count($sprstr); $i++){
            if(str_contains($sprstr[$i], $del)){
                $str = str_replace($sprstr[$i], '', $str);
                $strona = fopen($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php", "w") or die("Unable to open file!");
                fwrite($strona, $str);
                fclose($strona);
            }};
    };
};
$txt = implode(', ', $todel);
echo "usunięto: ".$txt;
?>