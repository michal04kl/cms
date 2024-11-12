<?php
$do = $_POST["us_opt_wyb"];
if($do == "del"){//przekierowanie na usuwanie
$number = $_POST["us_efected_nr"];
if($number==0){
    echo "nie wybrano żadnych kont";
}else{//wybór kont do usunęcia
    $chosen = $_POST['box'];
    $each = count($chosen);
    for($spr=0; $spr < $each; $spr++){
        $jeden = $chosen[$spr];
        $nazwa = "login".$jeden;
        $wyb = $_POST[$nazwa];
       if($wyb == $_COOKIE['in']){
            echo "błąd - konto do usunięcia ma taką samą nazwę jak użytkownik na którym jesteś zalogowany";
            return false;
        };
    };
    for($i=0; $i < $each; $i++){
        $one = $chosen[$i];
        $name = "login".$one;
        $wybrany = $_POST[$name];
        echo "\n$wybrany";
    };
};
};
if($do == "prev"){//przekierowanie na uprawnienia
    $number = $_POST["us_efected_nr"];
    if($number==0){echo "nie wybrano żadnych kont";}else{
    $wybrani = $_POST['box'];//sprawdzenie czy nie jesteśmy na tym samym koncie
    $każdy = count($wybrani);
    for($i = 0; $i < $każdy; $i++){
      $poj = $wybrani[$i];
      $name = "login".$poj;
      $sprawdzenie = $_POST[$name];
      if($sprawdzenie == $_COOKIE['in']){
        echo "błąd - nie możesz zmienić poziomu uprawnień konta na którym jesteś zalogowany";
        return false;
      };  
    };
    };
};
?>