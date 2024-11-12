<?php
$index = file($_SERVER['DOCUMENT_ROOT']."/index.php");
$top = '<title id="titled">';
$bot = '<h4 id="hp">';
for($i = 0; $i < count($index); $i++){
    $row = $index[$i];
    if(str_contains($row, $top)){
        $tt = strstr($row, "<"); 
        $tt = strip_tags($tt);
    };
    if(str_contains($row, $bot)){
        $bt = strstr($row, "<"); 
        $bt = strip_tags($bt);
    };
};
?>
<div id="titled">
    <form id="chct">
        <input type="text" name="top" class="tt" placeholder="tytuł w przeglądarce" autocomplete="off" value="<?php echo $tt; ?>">
        <input type="text" name="bot" class="tt" placeholder="tytuł na stronie" autocomplete="off" value="<?php echo $bt; ?>">
</form>
<button id="ttchanger">Zmień tytuły</button>
</div>
<script type="text/javascript">
    $("#ttchanger").click(function(){
        $.ajax({
            url:"/settings/cms/edit/chct.php",
                     type:"POST",
                     data:$("#chct").serialize(),
                     cache: false,
                     success:function(odp){
                      alert(odp);
                     } 
        });
    });
</script>