<?php
$dec = $_POST['dec'];
if($dec == "page"){ ?>
<div id="add_f_page">
<form id="add_page" enctype="multipart/form-data" action="/settings/cms/data/add/upolad.php" method="post">
<label for='send_page'><h1>Prześli skompresowaną stronę (format - *.zip)</h1></label><input type='file' id="#send_page" name="npage" accept=".zip">
<input type="submit" value="Wyślij na serwer" id="page_ab">
</form>
</div>
<?php   
};
if($dec == "art"){ ?>
<div id="add_f_art">
<form id="add_art" enctype="multipart/form-data" action="/settings/cms/data/add/art_add.php" method="post" >
<div id="art_top">
    <input type="text" id="title" placeholder="Tytuł artykułu" autocomplete="off" name="title" require>
    <div><label for="ikona">Wybierz ikonę dla artykułu (obraz)&nbsp;</label><input type="file" id="ikona" name="ikona" accept="image/*"></div>
</div>
<textarea id="tresc" name="tresc" placeholder="Treść artykułu" require></textarea>
<div><label for="zdj">Dodaj bibliotekę zdjęć (*.zip)&nbsp;</label><input type="file" id="zdj" name="zdj" accept=".zip"></div><br>
<input type="submit" value="dodaj artykuł" id="art_sub" onclick="
    var fdata = new FormData($('#add_art')[0]);
    $.ajax({
    url: '/settings/cms/data/add/art_add.php',
    type: 'POST',
    data: fdata,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (odp) {
    alert(odp);
    }
    });
    return false;
">
</form>
</div>
<?php
};
?>
