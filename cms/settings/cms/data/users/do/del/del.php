<?php
include $_SERVER['DOCUMENT_ROOT'].'/settings/login/settings/cookie/bzin/dbconfig.php';
$chosen = $_POST['box'];
$each = count($chosen);
echo "usunięto:";
for($i=0; $i < $each; $i++){//sprawdzanie
    $one = $chosen[$i];
    $name = "login".$one;
    $wybrany = $_POST[$name];
    echo "\n$wybrany";
    $baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');
    $zapytanie="SELECT `id` FROM `users` WHERE `users`.`login` = '$wybrany';";
    $result = $baza->query($zapytanie) or die ('bledne zapytanie');
    while($wiersz = $result->fetch_assoc()){
        $id = $wiersz['id'];
    };
    //usuwanie
    $zapytanie="DELETE FROM `users` WHERE `users`.`login` = '$wybrany';";
    $result = $baza->query($zapytanie) or die ('bledne zapytanie');
    $zapytanie="DELETE FROM uprawnienia WHERE `uprawnienia`.`user_id` = $id";
    $result = $baza->query($zapytanie) or die ('bledne zapytanie');
    $baza->close();
};
?>