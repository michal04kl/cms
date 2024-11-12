<!DOCTYPE html>
<html lang="pl-Pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj</title>
    <link rel="stylesheet" href="/settings/login/settings/log.css">
    <script type="text/javascript" src="/settings/frameworki/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="./settings/login.js"></script>
</head>
<body>
    <div id="fd">
    <h1>Zaloguj się</h1>
   <form method="post" action="./settings/cookie/cookie.php" id="logform">
    <input type="text" name="login" placeholder="login" autocomplete="off" class="inputy" id="i1"><br>
    <input type="password" name="passwd" placeholder="hasło" autocomplete="off" class="inputy" id="i2"><br>
    <div id="fbutony">
    <input type="submit" value="zaloguj">
    <input type="reset" value="wczyść">
    </div>
   </form> 
</div>
<p id="error"></p>
</body>
</html>