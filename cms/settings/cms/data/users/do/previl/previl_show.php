<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
session_start();
$hs = $_SESSION['historia'];
$ile = count($hs);
?>
<table id="us_level">
<tr><th>Użytkownik</th><th>Poziom uprwanień</th></tr>
<?php 
$baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
$zapytanie = "SELECT `users`.`login` as 'login', `uprawnienia`.`level` as 'level' FROM `users` JOIN `uprawnienia` on `users`.`id` = `uprawnienia`.`user_id`;";
$result = $baza->query($zapytanie) or die ('get error');
while($build = $result->fetch_assoc()){
    $name = $build['login'];
    $lvl = $build['level'];
    if($lvl==1){$txt="bloger";};
    if($lvl==2){$txt="edytor";};
    if($lvl==3){$txt="admin";};
    for($i = 0; $i < $ile; $i++){
    $who = $hs[$i][0];
    if($who == $name){
        $txt = $hs[$i][1];
    };
};    
echo "<tr><td>$name</td><td>$txt</td></tr>";
};
$baza->close();
echo "<script type='text/javascript'>
litery();
function litery(){//wielkość liter
    let wys = document.getElementById('ekran').getBoundingClientRect().height;
    let wl = Math.floor(wys /13)+'px';
    document.getElementById('us_level').style.fontSize=wl;
    };
    window.onresize = litery();
    </script>";
?>
</table>