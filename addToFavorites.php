<?php

session_start();

if(!isset($_SESSION["Favorites"])){
    $_SESSION["Favorites"] = [];
}

$favorites = $_SESSION["Favorites"];

if (isset($_GET["name"])){
    $queryS = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
}else{ 
    $queryS = "";
}


if(!array_search($_GET["song_id"], $favorites)){
    $favourites[] = $_GET["song_id"];
    $_SESSION["Favorites"] = $favorites;

    header("Location: favorites.php?$queryS");
} else{
    $queryM = "Song has already been added to Favorites page";
    header("Location: favorites.php?$queryM&$queryS");
}




?>