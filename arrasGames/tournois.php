<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>

<?php
require('headFoot/header.php')
?>
<html>
    <body background="img/arrasGames-bg-1.jpg";>
        <?php require_once('headFoot/nav.php') ;?>

    </body>
</html>