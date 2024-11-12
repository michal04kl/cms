<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
$konta = $_POST['login'];
$lp = count($konta);
$history = array();
for($i = 0; $i < $lp; $i++){
    $konto=$konta[$i];
    $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
    $zapytanie="SELECT `id` FROM `users` WHERE `login` = '$konto';";
    $result = $baza->query($zapytanie) or die ('get error');
    while($bk = $result->fetch_assoc()){
        $id = $bk['id'];
        $radio = "prevl$id";
        $upo = $_POST[$radio];
        $zapytanie3 = "SELECT `level` FROM `uprawnienia` WHERE `user_id` = '$id';";
        $result3 = $baza->query($zapytanie3) or die ('get error');
        while($same = $result3->fetch_assoc()){//sprawdzenie czy wysyłane dane nie są takie same jak istniejące
            $spr = $same["level"];
            if($spr != $upo){
                $before=$spr;
                $after=$upo;
                if($before==1){$tbefore = "bloger";};
                if($before==2){$tbefore = "edytor";};
                if($before==3){$tbefore = "admin";};
                if($after==1){$tafter = "bloger";};
                if($after==2){$tafter = "edytor";};
                if($after==3){$tafter = "admin";};
                $change = "$tbefore &rarr; $tafter";
                array_push($history, array($konto, $change));
            };
        };
        $zapytanie2="UPDATE `uprawnienia` SET `level` = '$upo' WHERE `uprawnienia`.`user_id` = '$id';";
        $result2 = $baza->query($zapytanie2) or die ('get error'); 
    };
    $baza->close();
    session_start();
    $_SESSION['historia']=$history;
};
?>