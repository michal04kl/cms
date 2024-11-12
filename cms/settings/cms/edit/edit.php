<div id="ek_link">
<div id='link'>
<?php
$id = $_POST['id'];
$name = $_POST['name'];
$sprcheck = file_get_contents($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php");
if(str_contains($sprcheck, "$id")){
    $chc = 1;
}else{$chc = 0;};
if($chc == 1){
$lcheck = 'checked';
$ulcheck = '';
};
if($chc == 0){
$lcheck = '';
$ulcheck = 'checked';
};
echo "<h1>$name</h1>";
?>
<form id='link_f'>
<input type='text' style='display:none;' value='<?php echo $id; ?>' name='id'>
<input type='text' style='display:none;' value='<?php echo $name; ?>' name='name'>
<div><label for='link'>Podłącz</label><input type='radio' id='link' name='connect' value='link' <?php echo $lcheck; ?> onclick='
if(this.checked){
    document.getElementById("metric").style.display="";
    document.getElementById("lnkdec").innerHTML="Podłącz";
    document.getElementById("lnkdec").style.display="";
    document.getElementById("lnkdec").setAttribute("d", "lnk");
};
'></div>
<div><label for='unlink'>Rozłącz</label><input type='radio' id='unlink' name='connect' value='unlink' <?php echo $ulcheck; ?>  onclick='
if(this.checked){
    document.getElementById("metric").style.display="none";
    document.getElementById("lnkdec").innerHTML="Rozłącz";
    document.getElementById("lnkdec").style.display="";
    document.getElementById("lnkdec").setAttribute("d", "unlnk");
};
'></div>
<div id='metric' style='display:none;'><input type='number' placeholder='szerokość (1-12)' min='1' max='12' name='wid' id='wid'></div>
</form>
<button id='lnkdec' style='display:none;' d='' onclick='
if($("#lnkdec").attr("d") == "lnk"){
    $.ajax({
    url:"/settings/cms/edit/link.php",
    type:"POST",
    data:$("#link_f").serialize(),
    success:function(callback){
        if(callback=="błąd - nie ustawiono metryk"){
        alert(callback);
        return false;
        }else{
            if(callback=="błąd - strona już jest podlinkowana"){
                alert(callback);
                return false; 
            };
            $.ajax({
                url:"/settings/cms/edit/div.php",
    type:"POST",
    data:{"div":callback},
    success:function(odp){
        alert(odp);
    }
            });
        };
        document.location.reload();
    }
    });
};
if($("#lnkdec").attr("d") == "unlnk"){
$.ajax({
    url:"/settings/cms/edit/link.php",
    type:"post",
    data:$("#link_f").serialize(),
    success:function(callback){
    alert(callback);
    document.location.reload();
    }
});
};
    return false;
'></button>
</div>
</div>