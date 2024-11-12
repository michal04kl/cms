<form method="POST" id="chc_form" action="/settings/cms/data/users/do/previl/base_prev.php">
<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
$wybrani = $_POST['box'];
$każdy = count($wybrani);
 for($i = 0; $i < $każdy; $i++){
   $poj = $wybrani[$i];//wyświetlenie uprawnień
   $name = "login".$poj;
   $konto = $_POST[$name];
    $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
    $zapytanie="SELECT `id` FROM `users` WHERE `login` = '$konto';";
    $result = $baza->query($zapytanie) or die ('get error');
    while($back = $result->fetch_assoc()){
        $idk = $back['id'];
        $zapytanie="SELECT `level` FROM `uprawnienia` WHERE `user_id` = '$idk';";
        $result = $baza->query($zapytanie) or die ('get error');
        while($odp = $result->fetch_assoc()){
            $lev = $odp['level'];
        ?> 
        <div class="upr_konto">
        <h2><input type="text" style="display: none;" name="login[]" class="in_pr" value="<?php echo $konto ?>"><?php echo $konto ?></h2>
        <div class="uprawnienia" style="text-align:center;">
            <h4>Zmień uprawnienia</h4>
            bloger:<input type="radio" name="prevl<?php echo "$idk"; ?>" value="1" <?php if($lev==1){ ?>checked="checked"<?php }; ?>><br>
            edytor:<input type="radio" name="prevl<?php echo "$idk"; ?>" value="2" <?php if($lev==2){ ?>checked="checked"<?php }; ?>><br>
            admin:<input type="radio" name="prevl<?php echo "$idk"; ?>" value="3" <?php if($lev==3){ ?>checked="checked"<?php }; ?>><br>
        </div>
        </div>
        <?php
    };
    };
    $baza->close();
 };
?>
</form>