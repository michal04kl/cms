<?php 
//include '/settings/login/settings/cookie/bzin/dbconfig.php';
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
$baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');//połączenie z bazą
$zapytanie="SELECT * FROM users";//select ostatniego id
$result = $baza->query($zapytanie) or die ('get error');//zdobycie loginów i haseł
echo "<form method='post' action='/settings/cms/data/users/edit.php' id='user_from'>";
echo "<input type='text' style='display: none;' name='us_opt_wyb' value='' id='us_opt_wyb'>";
echo "<table id='user_table'>";
echo "<tr><th>użytkownik</th><th>e-mail</th><th>zaznacz</th></tr>";
$n = 1;
while($wiersz = $result->fetch_assoc()){//poskładanie odpowiedzi
    $login = $wiersz['login'];
    $mail = $wiersz['email'];
    if($login == $_COOKIE['in']){
        $profile = "<u id='me'>$login</u>";
        echo "<tr><td id='log$n'>$profile<input type='text' style='display: none;' name='login$n' value='$login'></td><td id='mail$n'>$mail<input type='text' style='display: none;' name='mail$n' value='$mail' id='ml$n'></td><td id='box_td$n'><input type='checkbox' id='box$n' name='box[]' value='$n' class='checkbox' onclick='zaznacz(this);' onchange='sumarum(this);'></td></tr>";    
    }else{
    echo "<tr><td id='log$n'>$login<input type='text' style='display: none;' name='login$n' value='$login'></td><td id='mail$n'>$mail<input type='text' style='display: none;' name='mail$n' value='$mail' id='ml$n'></td><td id='box_td$n'><input type='checkbox' id='box$n' name='box[]' value='$n' class='checkbox' onclick='zaznacz(this);' onchange='sumarum(this);'></td></tr>";
    };
    $n = $n+1;
};
echo "</table>";
echo "<input type='text' style='display: none;' name='us_efected_nr' id='us_efected_nr' value=''>";
echo "</form>";
$baza->close();
?>
<script type='text/javascript' >
litery();
function zaznacz(e){//zaznaczenie
    let lp_box = e.getAttribute('value');
    let log = 'log'+lp_box;
    let mail = 'mail'+lp_box;
    let box = '#box'+lp_box;
    let box3 = 'box_td'+lp_box;
    const chck_spr = document.querySelector(box);
    if(chck_spr.checked){
       document.getElementById(log).style.cssText = 'color:#BAD6EB;background-color: #000321;';
       document.getElementById(mail).style.cssText = 'color:#BAD6EB;background-color: #000321;';
       document.getElementById(box3).style.cssText = 'color:#BAD6EB;background-color: #000321;'; 
    }else{
        document.getElementById(log).style.cssText = '';
        document.getElementById(mail).style.cssText = '';
        document.getElementById(box3).style.cssText = '';         
    };
};
function litery(){//wielkość liter
    let wys = document.getElementById('ekran').getBoundingClientRect().height;
    let wl = Math.floor(wys /13)+'px';
    document.getElementById('user_table').style.fontSize=wl;
    };
    window.onresize = function(){litery()};
    //ile jest zaznaczonych
    var nr = 0;
    hide(nr); 
    document.getElementById('us_efected_nr').setAttribute('value', nr);
    function dodaj(){
       nr = nr+1;
       document.getElementById('us_efected_nr').setAttribute('value', nr);
       hide(nr); 
    };
    function odejmij(){
        nr = nr-1;
        document.getElementById('us_efected_nr').setAttribute('value', nr);
        hide(nr);
    };
    var maile=[];
    function sumarum(t){
    if (t.checked == true){
        dodaj();
        let nr = t.value;
        let nrtxt = 'ml'+nr;
        let mail = document.getElementById(nrtxt).value;
       maile.push(mail);
       console.log(maile) ;
      } else {
         odejmij();
         maile.pop();
        console.log(maile);
      };
    };
    //wysyłanie maila
    $('#us_send').click(function(){
   var mtxt = 'mailto:'
    let mails = maile.toString();
    mtxt=mtxt+mails;
    window.open(mtxt);
    });
    function hide(nr){//howanie i pokazywanie opcji do których zaznaczenie jest wymagane
        if(nr>0){
            <?php if($_COOKIE["level"]>=3){?>document.getElementById('us_del').style.display='block';<?php };?>
            <?php if($_COOKIE["level"]>=1){?>document.getElementById('us_send').style.display='block';<?php };?>
            <?php if($_COOKIE["level"]>=3){?>document.getElementById('us_prev').style.display='block';<?php };?>
        }else{
           <?php if($_COOKIE["level"]>=3){?>document.getElementById('us_del').style.display='none';<?php };?>
           <?php if($_COOKIE["level"]>=1){?>document.getElementById('us_send').style.display='none';<?php };?>
           <?php if($_COOKIE["level"]>=3){?>document.getElementById('us_prev').style.display='none';<?php };?> 
        };
    };
    //edycja własnego profilu
    $("#me").click(function(){
        $("#ekran").load("/settings/cms/data/users/do/edit/own.php");
       document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; min-height:'80%'; height:'max-content'; background-color: #BAD6EB; max-height:'';";
    });
</script>
