<div id='del_pages_show'>
<form id='del_pages'>
<?php
$files = scandir($_SERVER['DOCUMENT_ROOT'].'/settings/cms/data/pages');
$nr = count($files);
for($i = 2; $i < $nr; $i++){
    $name = $files[$i];
    if(str_contains($name, "at_")){
        $name = substr($name, 3);
        $art = "style='color:#00C9CC; border: 2px solid #00C9CC;'";
        $arth = "style='border-bottom: 1px solid #00C9CC;'";
    }else{
        $art = "";
        $arth = "";
    };
echo "<div class='del_show_p' id='".$files[$i]."' ".$art.">
<h3 ".$arth.">".$name."</h3>
<input type='checkbox' name='strona[]' value='".$files[$i]."' class='del_p_chcbox' id='".$files[$i]."'>
</div>";
};
?>
</form>
<button id='del_c_pages'>Usuń zaznaczone strony/artykuły</button>
</div>
<script type="text/javascript">
    $(".del_p_chcbox").click(function(){
        if($(this).is(':checked')){
        var check = this.getAttribute("value");
        document.getElementById(check).style.boxShadow = "0px 0px 10px 10px #ff0000";
        }else{
            var check = this.getAttribute("value");
            document.getElementById(check).style.boxShadow = "none";
        };
    });
    $("#del_c_pages").click(function(){
       var names = $('.del_p_chcbox:checkbox:checked');
       var all = names.length;
       if(all==0){
        alert("błąd - nic nie wybrano");
        return false;
       };
       var napis = "";
       for(let i = 0; i <= all-2; i++){
        let plik = names[i].getAttribute('id');
        if(plik.includes("at_")){
            plik = plik.replace('at_', '');
        };
        napis = napis+""+plik+", ";
       };
       let plik = names[all-1].getAttribute('id');
        if(plik.includes('at_')){
            plik = plik.replace('at_', '');
        };
       napis = napis+""+plik;
       if(confirm("Czy napewno chcesz usunąć: "+napis+" ?")){
        $.ajax({
        url:"/settings/cms/data/del/del.php",
        type:"POST",
        data:$("#del_pages").serialize(),
        cache: false,
        success: function(odp){
            alert(odp);
            document.location.reload();
        }
        });
       }else{
        return false;
       };
    });
    jshg
</script>