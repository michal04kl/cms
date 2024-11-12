<?php
$topt = ">".$_POST['top'];
$bott = ">".$_POST['bot'];
$index = file($_SERVER['DOCUMENT_ROOT']."/index.php");
$ixtxt = file_get_contents($_SERVER['DOCUMENT_ROOT']."/index.php");
$top = '<title id="titled">';
$bot = '<h4 id="hp">';
for($i = 0; $i < count($index); $i++){
    $row = $index[$i];
    if(str_contains($row, $top)){
        $tt = strstr($row, ">");
        $tt = strstr($tt, "<", true);
    };
    if(str_contains($row, $bot)){
        $bb = strstr($row, ">");
        $bb = strstr($bb, "<", true);
    };
};
$ixtxt = str_replace($tt, $topt, $ixtxt);
$ixtxt = str_replace($bb, $bott, $ixtxt);
$strona = fopen($_SERVER['DOCUMENT_ROOT']."/index.php", "w") or die("Unable to open file!");
fwrite($strona, $ixtxt);
fclose($strona);
echo "zamieniono tytuły";
?>