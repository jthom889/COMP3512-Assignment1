<?php
require_once('./includes/config.inc.php');
include('./includes/helpers.inc.php');
require_once('./includes/db-classes.inc.php');



try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $songGateway = new SongDB($conn);
    
    if( isset($_GET['song_id']) ){
        $songs = $songGateway->generateSong($_GET['song_id']);

    } 
}
catch (Exception $e){ die($e->getMessage());}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="css/songinfo.css" />
</head>
<body> 
    <?php
    generateHeader();
    generateFooter();
    ?>

    <div class="center-box">
        <?php

        if(isset($_GET['song_id'])){
            foreach($songs as $song){
                echo "<h1>{$song['title']}</h1>";
                echo "<p>Artist: {$song['artist_name']}</p>";
                echo "<p>Artist Type: {$song['artist_type_id']}</p>";
                echo "<p>Genre: {$song['genre_name']}</p>";
                echo "<p>Year: {$song['year']}</p>";
                echo "<p>Duration: {$song['duration']} seconds</p>";
                echo "<p>BPM: {$song['bpm']}</p>";
                echo "<p>Energy: {$song['energy']}</p>";
                echo "<p>Danceability: {$song['danceability']}</p>";
                echo "<p>Liveness: {$song['liveness']}</p>";
                echo "<p>Valence: {$song['valence']}</p>";
                echo "<p>Acousticness: {$song['acousticness']}</p>";
                echo "<p>Speechiness: {$song['speechiness']}</p>";
                echo "<p>Popularity: {$song['popularity']}</p>";
            }
        } else {
            echo "Jonh";
        }
        ?>
    </div>

    <section></section>
    <footer></footer>

</body>
</html>













































