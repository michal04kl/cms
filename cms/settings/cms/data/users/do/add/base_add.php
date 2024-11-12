<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
$login = $_POST["login"];
$passwd = $_POST["password"];
$mail = $_POST["email"];
@ $prev = $_POST["prevl"];
//walidacja dancyh
if($login == NULL || $passwd == NULL || $mail == NULL || $prev == NULL){
    echo "należy wypełnić WSZYSTKIE pola";
}else{
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
  if(!isset($prev)){
    echo "nie wybrano poziomu uprawnień";
    return false;
  };
  $passwd = SHA1($passwd);
  //sprawdzenie czy nie ma już takiego loginu
  $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
  $zapytanie="SELECT IFNULL( (SELECT `login` FROM `users` WHERE `login` = '$login'), 20) AS 'sprawdz';";
  $result = $baza->query($zapytanie) or die ('bledne zapytanie');
  while($spr =  $result->fetch_assoc()){
    $same = $spr['sprawdz'];
    if($same != 20){
      echo "konto o takim loginie już istnieje";
      $baza->close();
      return false;
    };
  };
  $baza->close();
  //wprowadzanie do bazy 
    $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');//połączenie z bazą
    $zapytanie="INSERT INTO `users` (`id`, `login`, `pass`, `email`) VALUES (NULL, '$login', '$passwd', '$mail'); ";
    $result = $baza->query($zapytanie) or die ('bledne zapytanie');
    $zapytanie="SELECT * FROM `users` WHERE `login` = '$login'; ";
    $result = $baza->query($zapytanie) or die ('bledne zapytanie');
      $zapytanie="SELECT * FROM `users` WHERE `login` = '$login'; ";
      $result = $baza->query($zapytanie) or die ('bledne zapytanie');
    while($wiersz = $result->fetch_assoc()){
        $id = $wiersz['id'];
    };
    $zapytanie="INSERT INTO `uprawnienia` (`user_id`, `level`) VALUES ('$id', '$prev'); ";
    $result = $baza->query($zapytanie) or die ('bledne zapytanie');
    $baza->close();
    echo "użytkownik został dodany";
  };   
?>