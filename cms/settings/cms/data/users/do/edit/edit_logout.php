<?php
$usun = time() - 3600;
foreach ( $_COOKIE as $cookie => $wartosc ){//usuwanie ciastek
    setcookie( $cookie, $wartosc, $usun, '/' );
};
?>
<script type="text/javascript">
    window.location.replace("/index.php");
</script>