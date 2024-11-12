<?php
$target = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/";
$test = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/page_spr/";
//sprawdzenie czy istnieje
$name = $_FILES['npage']['name'];
if($name==NULL){
    echo "błąd - nie wybrano pliku";
    return false;
};
if(str_contains($name, "at_")){
    echo 'błąd - strona nie może zawierać "at_"';
    return false;
};
/*if(str_contains($name, " ")){
    echo 'błąd - strona zawiera spację';
    return false;
};*/
$spr0 = $test.$name;
$spr1 = $target.$name;
$nick = substr($name, 0, strpos($name, "."));
$spr2 = $target.$nick;
if(is_dir($spr2)){
echo "błąd - strona już istnieje";
}else{ 
if(file_exists($spr1)){
    echo "błąd - plik już jest wtrakcie przerabiania lub z powodu błędu plik jest nierozpakowany";
}else{
    move_uploaded_file( $_FILES['npage']['tmp_name'], $test.$name);
    $zip = new \ZipArchive;
    $res = $zip->open($spr0);
    if($res === TRUE){
    $zip->extractTo($test);
    $zip->close();
    };
    $ntest = scandir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/page_spr");
    if(count($ntest)>4){
        for($i = 2; $i < count($ntest); $i++){
            system("rm -rf ".escapeshellarg($test.$ntest[$i]));
            system('rmdir '.escapeshellarg($test.$ntest[$i]).' /s /q');
            @ unlink($test.$ntest[$i]);
        };
        echo "błąd - spakój wszystkie pliki strony do jednego folderu";
        return false;
    };
    for($k = 2; $k < count($ntest); $k++){
        system("rm -rf ".escapeshellarg($test.$ntest[$k]));
        system('rmdir '.escapeshellarg($test.$ntest[$k]).' /s /q');
    };

   //wysłanie
   rename($spr0, $spr1);
//move_uploaded_file( $_FILES['npage']['tmp_name'], $target.$name);
//rozpakoenie
$zip = new \ZipArchive;
$res = $zip->open($spr1);
if($res === TRUE){
$zip->extractTo($target);
$zip->close();
};
//usunięcie
unlink($spr1);
echo "strona została utworzona"; 
}};

?>