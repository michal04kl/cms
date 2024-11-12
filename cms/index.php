<!DOCTYPE html>
<html lang="pl-Pl">
<head>   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titled">CMS</title>
    <link rel="stylesheet" href="/settings/main/style.css">
    <script type="text/javascript" src="/settings/frameworki/jquery-3.6.1.min.js"></script>
</head>
<body>
    <header>
        <h4 id="hp">Twoja strona</h4>
        <a href="./settings/login/login.php" id="in">Zaloguj</a>
    </header>
    <iframe src='/settings/cms/data/manager/body.php' frameborder="0" width="100%" height="100%"></iframe>
</body>
<?php include "./settings/login/settings/session/session.php"; ?>
</html>