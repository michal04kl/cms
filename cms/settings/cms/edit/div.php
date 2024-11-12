<?php
$wpisz = fopen($_SERVER['DOCUMENT_ROOT']."/settings/cms/edit/show.php", "a") or die("Unable to open file!");
fwrite($wpisz, $_POST['div']);
fclose($wpisz);
?>