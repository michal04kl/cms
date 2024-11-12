<?php
$dir = $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/";
$fld = scandir($dir);
$fnr = count($fld);
?>
<div id="all_pages">
<?php
for($c = 2; $c < $fnr; $c++){
?>
<div id="<?php echo $fld[$c]; ?>" class="page" <?php if(str_contains($fld[$c], "at_")){echo "style='background-color:#00C9CC';";}; ?>><h4><?php 
if(str_contains($fld[$c], "at_")){
echo substr($fld[$c], strpos($fld[$c], "_")+1);
}else{
echo $fld[$c];    
};
?></h4></div>
<?php    
};
?>
<div id="add_new" class="page">&#43;</div>
<?php if($fnr > 2){ ?><div id="page_del" class="page">&#8722;</div><?php }; ?>
</div>
<script type='text/javascript'>
    $('#add_new').click(function(){
        document.getElementById("napis").innerHTML="<b>Tworzenie strony</b>";
        $("#ekran").load("/settings/cms/data/add/ad.php");
    });
    $("#page_del").click(function(){
        document.getElementById("napis").innerHTML="<b>Usuwanie stron</b>";
        $("#ekran").load("/settings/cms/data/del/dl.php");
    });
    $(".page").click(function(){
      var to = $(this).attr("id");
      var at_to = $("#"+to).text();
      if(to != "add_new" && to != "page_del"){
        if(!to.includes("at_")){
            $("#ekran").html("<iframe src='/settings/cms/data/pages/"+to+"' style='pointer-events: none; width:100%; height:100%;'></iframe>");
            $("#napis").html("strona: "+to+" (podgląd)");
        }else{
            $("#napis").html("artykuł: "+at_to);
            $("#ekran").html("<iframe src='/settings/cms/data/pages/"+to+"' style='pointer-events: none; width:100%; height:100%;'></iframe>");
            $("#ekran").append("<button id='at_edit' style='margin-left: 50%; margin-right: 50%; background-color: #BAD6EB;'>edytuj artykuł</button>");
        };
        $("#at_edit").click(function(){
            $("#ekran").append("<form id='#ad_edit_form' style='display:none'><input type='text' name='edit_page' id='edit_page'></form>");
            $("#edit_page").attr("value", to);
            $.ajax({
                url:"/settings/cms/data/add/edit.php",
                type:"POST",
                data:$("#edit_page").serialize(),
                cache: false,
                success: function(odp){
                    $("#ekran").html(odp);
                    $("#ekran").append("<form id='change_at' style='flex-direction:column; justify-content: space-evenly; align-items: flex-start'><input type='text' name='ntitle' id='ntitle' placeholder='tytuł' value='"+$("#title").text()+"' autocomplete='off' require><textarea autocomplete='off' require name='ncontent' id='ncontent' placeholder='treść artykułu' style='width:90%; height:80%'; resize: none;>"+$("#content").text()+"</textarea><button id='nsend'>zmień</button><button id='pch'>Edytuj bibliotekę/ikonę</button><input style='display:none' type='text' name='liblary' value='"+$("#biblioteka").text()+"'><input style='display:none' type='text' name='old' value='"+to+"'></form>");
                    $("#nsend").click(function(){
                        $.ajax({
                url:"/settings/cms/data/add/perm_edit.php",
                type:"POST",
                data:$("#change_at").serialize(),
                cache: false,
                success: function(odp2){
                    alert(odp2);
                }   
                        });
                        document.location.reload();
                        return false;
                    });
                    $("#pch").click(function(){
                        $.ajax({
                            url:"/settings/cms/data/add/perm_edit_buttons.php",
                type:"POST",
                data:$("#change_at").serialize(),
                cache: false,
                success: function(odp3){
                    document.getElementById("ekran").innerHTML=odp3;
                    //biblioteka

                    $("#edit_lib").click(function(){//edytuj
                        var values = {
                            'do':'edit',
                            'file': to 
                        };
                        $.ajax({
                            url:"/settings/cms/data/add/lib_edit.php",
                            type:"POST",
                            data:values,
                            cache: false,
                            success: function(){alert("otworzono bibliotekę w oknie foldera")}  
                        });
                    });

                    $("#del_lib").click(function(){//usuń
                        if(confirm("Czy napewno chcesz usunąc bibliotekę z tego artykułu?")){
                            var values = {
                            'do':'del',
                            'file': to
                        };
                        $.ajax({
                            url:"/settings/cms/data/add/lib_edit.php",
                            type:"POST",
                            data:values,
                            cache: false,
                            success: function(){alert("usunięto bibliotekę")}  
                        });
                        }else{
                            return false;
                        };
                    });

                    $("#add_lib").click(function(){//dodaj
                        fdata = new FormData($('#add_lib_f')[0]); 
                        fdata.append('do', 'add');
                        fdata.append('file', to);
                        $.ajax({
                        url: '/settings/cms/data/add/lib_edit.php',
                        type: 'POST',
                        data: fdata,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                            success: function(odp6){
                                if(odp6 == "błąd - nie wybrano pliku" || odp6 == "błąd - zdjęcia włóż w foldery przed ich zapakowaniem"){
                                    alert(odp6);
                                }else{
                                alert("dodano bibliotekę");
                                document.location.reload();
                            };
                            }  
                        });
                        return false;
                    });

                    //ikona

                    $("#change_ik_but").click(function(){//zmień
                        fdata = new FormData($('#edit_ik_f')[0]);
                        fdata.append('do', 'chc');
                        fdata.append('file', to);
                        $.ajax({
                        url: '/settings/cms/data/add/ico_edit.php',
                        type: 'POST',
                        data: fdata,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                            success: function(odp9){
                                if(odp9 == "błąd - nie wybrano pliku"){
                                    alert(odp9);
                                }else{
                                    alert("zmienieono ikonę");
                                    document.location.reload();
                                }
                            }
                        });
                        return false;
                    });

                    $("#del_ik").click(function(){//usuń
                        var values = {
                            'do':'del',
                            'file': to
                        };
                        $.ajax({
                            url:"/settings/cms/data/add/ico_edit.php",
                            type:"POST",
                            data:values,
                            cache: false,
                            success: function(){
                                alert("usunięto ikonę");
                                document.location.reload()
                                }  
                        });
                    });

                        $("#add_ik_but").click(function(){//dodaj
                            fdata = new FormData($('#add_ik_f')[0]);
                            fdata.append('do', 'add');
                            fdata.append('file', to);
                            $.ajax({
                        url: '/settings/cms/data/add/ico_edit.php',
                        type: 'POST',
                        data: fdata,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                            success: function(odp7){
                                if(odp7!="błąd - nie wybrano pliku"){
                                alert("dodano ikonę");
                                document.location.reload();
                                }else{
                                    alert(odp7);
                                };
                            }
                        });
                    return false;
                });
                }     
                        });
                        return false;
                    });
        }
            });
        });
      };
   });
</script>