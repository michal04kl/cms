<?php
$do = $_POST['do'];
if($do=="edit"){
 shell_exec("start ".$_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary");   
};
if($do=="del"){//zmiana kontentu
    $scs = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/index.php";
    $content = file_get_contents($scs);
    $script = '
    <?php
    $pics = scandir("./liblary");
    for($i=2;$i<count($pics);$i++){
        ?>
    <img src="./liblary/<?php echo $pics[$i]; ?>">
    <?php
    };
    ?>
    ';
    $del_script = "";
    $content = str_replace($script, $del_script, $content);
    file_put_contents($scs, $content);
    system("rm -rf ".escapeshellarg($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary"));
    system('rmdir '.escapeshellarg($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary").' /s /q');
};
if($do=="add"){
    $scs = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/index.php";
    $content = file_get_contents($scs);
    $script = '
    <div id="biblioteka">
    <?php
    $pics = scandir("./liblary");
    for($i=2;$i<count($pics);$i++){
        ?>
    <img src="./liblary/<?php echo $pics[$i]; ?>">
    <?php
    };
    ?>
    </div>';
    $old_script = '<div id="biblioteka"></div>';
    $content = str_replace($old_script, $script, $content);
    file_put_contents($scs, $content);
    if($_FILES['add_lib_i']['name']!=NULL){
        mkdir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary");
        $libp = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary";
        $lib = $_FILES['add_lib_i']['name'];
        $path = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file'];
        move_uploaded_file($_FILES['add_lib_i']['tmp_name'], $libp.'/'.$lib);
        $zip = new \ZipArchive;
        $res = $zip->open($libp."/".$lib);
        if($res === TRUE){
        $zip->extractTo($libp);
        $zip->close();
        unlink($libp."/".$lib);
        $liball = scandir($libp);
        for($i = 2; $i < count($liball); $i++){
            if(is_file($libp.'/'.$liball[$i])){ 
                echo "błąd - zdjęcia włóż w foldery przed ich zapakowaniem";
                system("rm -rf ".escapeshellarg($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary"));
                system('rmdir '.escapeshellarg($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/".$_POST['file']."/liblary").' /s /q');
                return false;
            };
        };
        $many = count($liball);
        for($i = 2; $i < $many; $i++){
            if(is_dir($libp.'/'.$liball[$i])){
                $kat = $libp.'/'.$liball[$i];
                $out=scandir($libp.'/'.$liball[$i]);
                for($in = 2; $in < count($out); $in++){
                $oldp = $libp.'/'.$liball[$i].'/'.$out[$in];
                $newp = $libp.'/'.$out[$in];
                rename($oldp, $newp);
                $i = 2;
                $many = count($liball);
                };
                rmdir($kat);
            };
        };
    }else{echo "błąd - nie wybrano pliku";};

}};
?>