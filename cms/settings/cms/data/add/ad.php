<div id="decide">
    <div id="n_page">
    Dodaj nową stronę
    </div>
    <div id="n_article">
    Dodaj nowy artykuł
    </div>
</div>
<form method="post" action="/settings/cms/data/add/perm_add.php" id="dec_fr" style="display:none">
<input type="text" id="dec" name="dec">
</form>
<script type="text/javascript">
    $("#n_page").click(function(){
        $("#dec").attr("value", "page");
        send();
    });
    $("#n_article").click(function(){
        $("#dec").attr("value", "art");
        send();
    });
    function send(){
        $.ajax({
            url:"/settings/cms/data/add/perm_add.php",
            type:"post",
            data:$("#dec_fr").serialize(),
            cashe: false,
            success:function(str){
                document.getElementById("ekran").innerHTML=str;
                $("#add_page").submit(function(e){
                    e.preventDefault();
                    //przesyłanie plików ajaxem
                    var fdata = new FormData($(this)[0]);
                    $.ajax({
                        url: '/settings/cms/data/add/upolad.php',
                        type: 'POST',
                        data: fdata,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (odp) {
                        alert(odp);
                        }
                    });
                    document.getElementById("add_page").reset();
                    return false;
                });
            }
        });
    };
</script>