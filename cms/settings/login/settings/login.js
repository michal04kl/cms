$(document).ready(function(){
    $("#logform").submit(function(){
        $.ajax({
        url:"./settings/cookie/cookie.php",
        type:"POST",
        data:$("#logform").serialize(),
        cache: false,
        success: function(odp){
            const wyrok = odp;
            if(wyrok == "brak loginu lub hasła"){
                document.getElementById("error").innerHTML=wyrok;
                document.getElementById("i1").value="";
                document.getElementById("i2").value="";
            };
            if(wyrok == "błędne login lub hasło"){
                document.getElementById("error").innerHTML=wyrok;
                document.getElementById("i1").value="";
                document.getElementById("i2").value="";
            };//co zrobić jeśli się nie zgadza
            if(wyrok == "zapraszam"){
                location.replace("/index.php");
            };//co zrobić jak się zgadza
        }
});
return false;
});    
});