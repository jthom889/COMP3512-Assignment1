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
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>
<body> 
    <?php
    generateHeader();
    generateFooter();
    ?>

    <section>
        <div class="center-box">
            <?php

            if(isset($_GET['song_id'])){
                foreach($songs as $song){
                    echo "<h2>{$song['title']}</h1>";
                    echo "<p><strong>Artist:</strong> {$song['artist_name']}</p>";
                    echo "<p><strong>Artist Type:</strong> {$song['artist_type_id']}</p>";
                    echo "<p><strong>Genre:</strong> {$song['genre_name']}</p>";
                    echo "<p><strong>Year:</strong> {$song['year']}</p>";
                    echo "<h3>Special Categories</h3>";
                    echo "<p><strong>Duration:</strong> "; 
                        toMin($song['duration']);
                    echo " minutes</p>";
                    echo "<p><strong>BPM:</strong> {$song['bpm']}</p>";
                    echo "<p><strong>Energy:</strong> {$song['energy']}</p>";
                    echo "<p><strong>Danceability:</strong> {$song['danceability']}</p>";
                    echo "<p><strong>Liveness:</strong> {$song['liveness']}</p>";
                    echo "<p><strong>Valence:</strong> {$song['valence']}</p>";
                    echo "<p><strong>Acousticness:</strong> {$song['acousticness']}</p>";
                    echo "<p><strong>Speechiness:</strong> {$song['speechiness']}</p>";
                    echo "<p><strong>Popularity:</strong> {$song['popularity']}</p>";
                }
            } else {
                echo "No song found";
            }
            ?>
        </div>
    </section>

</body>
</html>













































