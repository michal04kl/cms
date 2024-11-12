<?php
$title=$_POST['ntitle'];
$old=$_POST['old'];
if(is_dir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/at_".$title)){
    if("at_".$title == $old){
        $con = nl2br($_POST['ncontent']);
        if($_POST['liblary']!=NULL){
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
            <div id="content">'.$con.'</div><br>
            <div id="biblioteka">'.$script.'</div>
        </body>
        </html>
            ';
        $path = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$old";
        $plik = fopen("$path/index.php", "w") or die("Unable to open file!");
        fwrite($plik, $page);
        fclose($plik);
        rename($path, $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/at_".$title);
        echo "zmienieono";  
    }else{
    echo "błąd - artykuł o takim tytule już istnieje";
    };
}else{
$con = nl2br($_POST['ncontent']);
if($_POST['liblary']!=NULL){
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
    <div id="content">'.$con.'</div><br>
    <div id="biblioteka">'.$script.'</div>
</body>
</html>
    ';
$path = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$old";
$plik = fopen("$path/index.php", "w") or die("Unable to open file!");
fwrite($plik, $page);
fclose($plik);
rename($path, $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/at_".$title);
echo "zmienieono";
};
?>