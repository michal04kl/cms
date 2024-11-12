<form id='cp_form'>
<?php
$pages = scandir($_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages");
$nr = count($pages);
if($nr == 2){
    echo "błąd - żadna strona ani artykuł nie został dodany";
    return false;
}else{
    for($i = 2; $i < $nr; $i++){
        if(str_contains($pages[$i], "at_")){
            $name = substr($pages[$i], strpos($pages[$i], "_")+1);
            $style = "style=' border: 3px solid #00C9CC; color: #00C9CC;'";
            }else{
            $name = $pages[$i];
            $style = "";    
            };
    echo "<label for='".$pages[$i]."' id='".$pages[$i]."' class='lbpg' ".$style."><h4>".$name."</h4></label>";
    echo "<input type='text' style='display:none' value='".$pages[$i]."' name='".$pages[$i]."' id='".$pages[$i]."'>";
    };
};
?>
</form>