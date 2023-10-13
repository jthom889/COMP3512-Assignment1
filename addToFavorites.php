<?php

session_start();

if(!empty($_GET["song_id"])){
    $_SESSION["Song" . $_GET['song_id']] = $_GET["song_id"];
}

header("Location: favorites.php?s={$_GET['song_id']}");
exit();



?>