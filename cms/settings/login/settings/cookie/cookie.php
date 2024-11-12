<?php
$spr = 0;
$login = $_POST["login"];
$haslo = SHA1($_POST["passwd"]);
if($login == NULL || $haslo == NULL){//walidacja loginu i hasła
echo "brak loginu lub hasła";
}else{
include 'bzin/dbconfig.php';//dołączenie ustawień bazy
$baza = mysqli_connect($server,$user,$pass,$base) or ('connection error');//połączenie z bazą
$zapytanie="SELECT * FROM users ORDER BY id DESC LIMIT 1";//select ostatniego id
$result = $baza->query($zapytanie) or die ('get error');//zdobycie loginów i haseł
$wiersz = $result->fetch_assoc();//poskładanie odpowiedzi
$sprid = $wiersz['id'];//dostanie id ostatniego wiersza
$zapytanie2="SELECT * FROM users";//select wszystkich login i haseł
$resultspr = $baza->query($zapytanie2) or die ('spr get error');
while($wierszspr = $resultspr->fetch_assoc()){
    $sprlogin = $wierszspr['login'];
    $sprhaslo = $wierszspr['pass'];
    if($sprlogin == $login && $sprhaslo == $haslo){//co zrobić po pomyślnym sprawdzeniu
        echo "zapraszam";
        $spr = 1;
        $ttl = time()+3600;
        setcookie("in", "$login", $ttl, "/");
        //cookie previlages
    $user_id = $wierszspr['id'];
    $zapytanie3="SELECT * FROM uprawnienia";//select wszystkich login i haseł
    $wynik = $baza->query($zapytanie3) or die ('spr get error');
    while($upo = $wynik->fetch_assoc()){
    $prev_id = $upo['user_id'];
    $level = $upo['level'];
    if($prev_id == $user_id){
    setcookie("level", "$level", $ttl, "/");
    }
    };
    };
};//poskładanie odpowiedzi + sprawdzenie poprawności
if($spr == 0){
    echo "błędne login lub hasło";
};//w przypadku kiedy jest błąd
/*echo "zapraszam";
$spr = 1;
setcookie("in", "$login", time()+3600, "/");*/
$baza->close();
};
?>