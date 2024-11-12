<?php
$title = $_POST['title'];
$content = nl2br($_POST['tresc']);
$dirname = "at_".$title;
if(strpos($title, " ")!=false){
$fname = str_replace(" ","_",$title);
$dirname = "at_".$fname;
};
$target = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/";
$path = $target.$dirname;
$icon = $_FILES['ikona']['name'];
$lib = $_FILES['zdj']['name'];
$roz = substr($icon, strpos($icon, ".")+1);
$ipath = $path."/".$icon;
//sprawdzenie czy artykuł istnieje
if(is_dir($path)){
    echo "błąd - artykuł o takim tytule już istnieje";
}else{//stworzenie artykułu
    mkdir($path);
    if($lib!=NULL){
        move_uploaded_file($_FILES['zdj']['tmp_name'], $path.'/'.$lib);
        $zip = new \ZipArchive;
        $res = $zip->open($path."/".$lib);
        if($res === TRUE){
        $zip->extractTo($path);
        $zip->close();
        unlink($path."/".$lib);
        $liball = scandir($path);
        for($i = 2; $i < count($liball); $i++){
            if(is_file($path.'/'.$liball[$i])){ 
                echo "błąd - zdjęcia włóż w foldery przed ich zapakowaniem";
                system("rm -rf ".escapeshellarg($path));
                system('rmdir '.escapeshellarg($path).' /s /q');
                return false;
            };
        };
        rename($path.'/'.$liball[2],$path."/liblary");
        if(isset($liball[3])){
            for($i=3; $i < count($liball); $i++){
                $out = scandir($path.'/'.$liball[$i]);
                for($in = 2; $in < count($out); $in++){
                    $oldp = $path.'/'.$liball[$i].'/'.$out[$in];
                    $newp = $path."/liblary"."/".$out[$in];
                    rename($oldp, $newp);
                };
                rmdir($path.'/'.$liball[$i]);
            };
        }};
    };
    $plik = fopen("$path/index.php", "w") or die("Unable to open file!");
    if($lib!=NULL){
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
}else{
$script = '';
};
    $page = '
    <!DOCTYPE html>
<html lang="pl-Pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$title.'</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 id="title">'.$title.'</h1>
    <div id="content">'.$content.'</div><br>
    <div id="biblioteka">'.$script.'</div>
</body>
</html>
    ';
    fwrite($plik, $page);
    fclose($plik);
    $plik = fopen("$path/style.css", "w") or die("Unable to open file!");
    $page = '
    html{
        min-height: min-content;
        height: 100%;
        display: flex;
        justify-content: center;
        background-color: #000321;
    }
    body{
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
        min-height: max-content;
        align-content: space-around;
        align-items: center;
        min-width: max-content;
        width: 55%;
        background-color: #0e0c38;
        color: #BAD6EB;
        box-shadow: 5px 5px 15px#000000;
    }
    #content, #biblioteka{
        width: 65%;
    }
    #biblioteka{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        width: 100%;
    }
    h1{
        color: #00C9CC;
    }
    img{
        border: 3px solid #00C9CC;
        width:600px;
        height: 500px;
    }
    img:hover{
        border-color: #BAD6EB;
    } 
    ';
    fwrite($plik, $page);
    fclose($plik); 
    if($icon!=NULL){
        move_uploaded_file($_FILES['ikona']['tmp_name'], $ipath);
        rename($ipath, $path."/icon.".$roz);
        };
    echo "utworzono artykuł";
};
/* 

    <!DOCTYPE html>
<html lang="pl-Pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 id="title">test</h1>
    <div id="content">test</div><br>
    <div id="biblioteka"><?php
    $pics = scandir("./liblary");
    for($i=2;$i<count($pics);$i++){
        echo "<img src='./liblary/".$pics[$i]."'>";
    };
    ?></div>
</body>
</html>
    
*/
?>