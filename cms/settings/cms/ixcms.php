<?php
if(isset($_COOKIE["in"])){
?>

<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaścianek</title>
    <link rel="stylesheet" href="./settings/cms.css">
    <script type="text/javascript" src="/settings/frameworki/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="./settings/cms.js"></script>
</head>
<body>

 <header>
 <h4 id="hp">Witaj <?php echo $_COOKIE["in"] ?></h4>
 <a id="safe">Zapisz zmiany</a>
 <a href="/index.php" id="out">Wyloguj</a>
 </header>

 <main>
<div id="left">
    <?php if($_COOKIE["level"]>=1){?><h5 id="show" t="strona: ">Pokaż podgląd strony</h5><?php };?>
    <?php if($_COOKIE["level"]>=2){?><h5 id="edit" t="strona: ">Edytuj stronę główną</h5><?php };?>
    <?php if($_COOKIE["level"]>=1){?><h5 id="things" t="strona: ">Edytuj kontet</h5><?php };?>
    <?php if($_COOKIE["level"]>=1){?><h5 id="user">Użytkownicy</h5><?php };?>
</div>

<div id="opcje">

<div class="option" id="show_op">
<h1>Strony do podglądu:</h1>
<h3 id="index">Strona główna</h3>
<h3 id="login">Strona logowania</h3>
</div>

<div class="option" id="edit_op">
<h1>Działania na dopięciach</h1>
<h3 id='link'>Dopnij/Odepnij stronę lub artykuł</h3>
<h3 id='title'>Edytuj tytuły strony</h3>
</div>

<div class="option" id="things_op"> 
<h1>Legenda:</h1>
<h3>Opcja - <p style="padding:6%; border: 1px solid #000000; background-color:#9DCAD4;"></p></h3>
<h3>Strona - <p style="padding:6%; border: 1px solid #000000; background-color:#BAD6EB;"></p></h3>
<h3>Artykuł - <p style="padding:6%; border: 1px solid #000000; background-color:#00C9CC;"></p></h3>
</div>

<div class="option" id="user_op"> 
<h1>Działania na użytkownikach</h1>
<?php if($_COOKIE["level"]>=3){?><h3 id="us_add">Dodaj</h3><?php };?>
<?php if($_COOKIE["level"]>=3){?><h3 id="us_del">Usuń</h3><?php };?>
<?php if($_COOKIE["level"]>=1){?><h3 id="us_send">Wyślij maila</h3><?php };?>
<?php if($_COOKIE["level"]>=3){?><h3 id="us_prev">Edytuj uprawnienia</h3><?php };?>
<?php if($_COOKIE["level"]>=1){?><h3 id="us_show">Wyświetl użytkowników</h3><?php };?>
</div>

</div>

<div id="right">
<h1 id="napis"></h1>
<div id="ekran"></div>
</div>

 </main>
</body>
</html>

<?php
}else{//cofnij na stronę główną?>
<script>
location.replace("/index.php");
</script>
<?php
    };
?>