
            <!DOCTYPE html>
        <html lang="pl-Pl">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>test</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1 id="title">test</h1>
            <div id="content">test</div><br>
            <div id="biblioteka">
            <?php
            $pics = scandir("./liblary");
            for($i=2;$i<count($pics);$i++){
                ?>
            <img src="./liblary/<?php echo $pics[$i]; ?>">
            <?php
            };
            ?>
            </div>
        </body>
        </html>
            