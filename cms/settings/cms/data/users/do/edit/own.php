<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
$profil = $_COOKIE['in'];
$baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
$zapytanie="SELECT * FROM `users` WHERE `login`='$profil';";
$result = $baza->query($zapytanie) or die ('get error');
$wiersz = $result->fetch_assoc();
?>
<form type="post" action="/settings/cms/data/users/do/edit/own_base.php" id="edit_you">
<table id="u_tab">
<tr id="nname"><td>zmień login:</td><td><input type="text" name="edit_name" autocomplete="off" required value="<?php echo $wiersz["login"]; ?>"></td></tr>
<tr id="pass" style='display: none;'><td>nowe hasło:</td><td><input type="text" autocomplete="off" name="password" id="pass_in"></td></tr>
<tr id="pass_spr" style='display: none;'><td>powtórz hasło:</td><td><input type="text" autocomplete="off" name="password_again" id="pass_spr_in"></td></tr>
<tr id="mail"><td>zmień maila:</td><td><input type="text" name="mail" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required value="<?php echo $wiersz["email"]; ?>"></td></tr>
<tr id="buttons"><td><input type="submit" value="zmień"></td>
<td><input type="reset" value="anuluj" id="go_back"></td>
<td><button id="passchc">Zmień hasło</td></tr>
</table>
<h4 id="error"></h4>
</form>
<?php
$baza->close();
?>
<script type="text/javascript">
    document.getElementById("napis").innerHTML="Edytuj profil <i><?php echo $profil; ?></i>";
    $("#go_back").click(function(){
        document.getElementById("ekran").style="border-style:outset; border-color:#0000f0; border-width: 5%; box-shadow: 5px 5px 5px #000000; min-height:80%; height:max-content; background-color: #BAD6EB; max-height:'';";
        $("#ekran").load("/settings/cms/data/users/users.php");
        document.getElementById("napis").innerHTML="<b>Użytkownicy:</b>";
    });
    $("#passchc").click(function(){
        document.getElementById("pass").style="display: table-row;";
        document.getElementById("pass_spr").style="display: table-row;";
        $("#pass_in").prop('required', true);
        $("#pass_spr_in").prop('required', true);
        document.getElementById("passchc").style="display: none;";
        return false;
    });
    $("#edit_you").submit(function(){
        $.ajax({
        url:"/settings/cms/data/users/do/edit/own_base.php",
        type:"POST",
        data:$("#edit_you").serialize(),
        cache: false,
        success:function(back){
            if(back=="hasła się różnią" || back=="błąd - wpisano spację" || back=="login musi mięc przynajmniej 4 znaki" || back=="hasło musi mieć przynajmniej 8 znaków" || back=="błąd - taki profil już isntnieje"){
                document.getElementById("error").innerHTML=back;
                return false;
            };
            if(back=="poszło"){
                alert("nastąpi wylogowanie");
                window.location.replace("/settings/cms/data/users/do/edit/edit_logout.php");
            };
        } 
        });
        return false;
    });
</script>