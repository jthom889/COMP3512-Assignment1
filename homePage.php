<?php
    require_once('./includes/config.inc.php');
    include('./includes/helpers.inc.php');
    include('./includes/db-classes.inc.php');

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songGateway = new SongDB($conn);
        $artistGateway = new ArtistDB($conn);
        $genreGateway = new GenreDB($conn);
    
    } catch (PDOException $e) {
        die($e->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<?php
        generateHeader();
        generateFooter();
    ?> 
    
    <section class="content">

        <div class="list top genre">
            <h3>Top Genre</h3>
            <?php 
                $genres = $genreGateway->getTopGenres();
                outputCatagories($genres);
            ?>

        </div>

        <div class="list top artists">
            <h3>Top Artists</h3>
            <?php 
                $artists = $artistGateway->getTopArtists();
                outputCatagories($artists);
            ?>

        </div>

        <div class="list most popular">
            <h3>Most Popular Songs</h3>
            <?php 
                $songs = $songGateway->getMostPopular();
                outputSongs($songs);
            ?>

        </div>

        <div class="list one hit wonder">
            <h3>One Hit Wonders</h3>
            <?php 
                $songs = $songGateway->getOneHits();
                outputSongs($songs);
            ?>

        </div>

        <div class="list longest acoustic">
            <h3>Longest Acoustic Songs</h3>
            <?php 
                $songs = $songGateway->getLongestAcoustic();
                outputSongs($songs);
            ?>

        </div>

        <div class="list at the club">
            <h3>At The Club</h3>
            <?php 
                $songs = $songGateway->getAtTheClub();
                outputSongs($songs);
            ?>

        </div>

        <div class="list running">
            <h3>Running Songs</h3>
            <?php 
                $songs = $songGateway->getRunning();
                outputSongs($songs);
            ?>

        </div>

        <div class="list studying">
            <h3>Studying</h3>
            <?php 
                $songs = $songGateway->getStudying();
                outputSongs($songs);
            ?>

        </div>

    </section>


</body>
</html>