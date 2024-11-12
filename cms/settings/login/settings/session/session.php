<?php
if(!isset($_COOKIE["in"])){//uswanie cookies po wygaśnięciu
    $usun = time() - 3600;
    foreach ( $_COOKIE as $cookie => $wartosc ){//usuwanie ciastek
        setcookie( $cookie, $wartosc, $usun, '/' );
    };
};
 if(isset($_COOKIE["in"])){//stworzenie sesji
     session_start();
    $_SESSION["in"]=1;
    $_SESSION["name"] = $_COOKIE["in"];
};
if(@ $_SESSION["in"] == 1){ ?>
<script type="text/javascript">//co zrobić ze stworzoną sesją
document.getElementById("hp").innerHTML="Witaj <?php echo $_SESSION["name"]; ?>";
document.getElementById("in").innerHTML="Wejdź";
document.getElementById("in").setAttribute("href", "./settings/cms/ixcms.php");
</script>
<?php }; ?>