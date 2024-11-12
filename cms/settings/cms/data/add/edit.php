<?php
$file = $_POST['edit_page'];
?>
<div style="display:none;"><?php @ include @ $_SERVER['DOCUMENT_ROOT']."/settings/cms/data/pages/$file/index.php" ?></div>
<h1 id="test"></h1>