<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
if($_POST["password"]!=NULL){
    $pass1 = sha1($_POST["password"]);
    $pass2 = sha1($_POST["password_again"]);
    if($pass1!=$pass2){
        echo "hasła się różnią";
        return false;
    }else{
        $login = $_POST['edit_name'];
        $passwd = $_POST['password'];
        $lcheck1 = strlen($login);
        $lcheck2 = explode(" ", $login);
        $pcheck1 = strlen($passwd);
        $pcheck2 = explode(" ", $passwd);
        if(isset($lcheck2[1]) || isset($pcheck2[1])){
          echo "błąd - wpisano spację";
          return false;
        };
        if($lcheck1 < 4){
          echo "login musi mięc przynajmniej 4 znaki";
          return false;
        };
        if($pcheck1 < 8){
          echo "hasło musi mieć przynajmniej 8 znaków";
          return false;
        };
        if($login!=$_COOKIE['in']){
        $old_l = $_COOKIE['in'];
        $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
        $zapytanie="SELECT * FROM `users`;";
        $result = $baza->query($zapytanie) or die ('bledne zapytanie');
        while($wiersz = $result->fetch_assoc()){
            $l_new_spr=$wiersz['login'];
            if($login==$l_new_spr){
                echo "błąd - taki profil już isntnieje";
               $baza->close(); 
               return false;
            };
        }};
        $old = $_COOKIE['in'];
        $new_ml = $_POST['mail'];
        $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
        $zapytanie="SELECT `id` FROM `users` where `login`='$old';";
        $result = $baza->query($zapytanie) or die ('bledne zapytanie');
        $wiersz = $result->fetch_assoc();
        $id = $wiersz['id'];
        $zapytanie="UPDATE `users` SET `login`='$login', `email`='$new_ml', `pass`='$pass2' WHERE `users`.`id` = '$id';";
        $result = $baza->query($zapytanie) or die ('bledne zapytanie');
        $baza->close();
        echo "poszło";
        return false;
    };

}else{
    $login = $_POST['edit_name'];
    $lcheck1 = strlen($login);
    $lcheck2 = explode(" ", $login);
    if(isset($lcheck2[1])){
        echo "błąd - wpisano spację";
        return false;
      };
      if($lcheck1 < 4){
        echo "login musi mięc przynajmniej 4 znaki";
        return false;
      };
      if($login!=$_COOKIE['in']){
        $old_l = $_COOKIE['in'];
        $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
        $zapytanie="SELECT * FROM `users`;";
        $result = $baza->query($zapytanie) or die ('bledne zapytanie');
        while($wiersz = $result->fetch_assoc()){
            $l_new_spr=$wiersz['login'];
            if($login==$l_new_spr){
                echo "błąd - taki profil już isntnieje";
               $baza->close(); 
               return false;
            }}};
            $old = $_COOKIE['in'];
            $new_ml = $_POST['mail'];
            $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
            $zapytanie="SELECT `id` FROM `users` where `login`='$old';";
            $result = $baza->query($zapytanie) or die ('bledne zapytanie');
            $wiersz = $result->fetch_assoc();
            $id = $wiersz['id'];
            $zapytanie="UPDATE `users` SET `login`='$login', `email`='$new_ml' WHERE `users`.`id` = '$id';";
            $result = $baza->query($zapytanie) or die ('bledne zapytanie');
            $baza->close(); 
            echo "poszło";
            return false;
};
?>