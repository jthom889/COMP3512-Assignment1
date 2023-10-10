<?php
require_once('./includes/config.inc.php');
include('./includes/helpers.inc.php');
include('./includes/db-classes.inc.php');


try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));

    $songGateway = new SongDB($conn);

    $row = $songGateway -> generateSong(1001);
    if ($row) {
        echo "<h1>{$row['title']}</h1>";
        echo "<p>Artist: {$row['artist_name']}</p>";
        echo "<p>Artist Type: {$row['artist_type_id']}</p>";
        echo "<p>Genre: {$row['genre_name']}</p>";
        echo "<p>Year: {$row['year']}</p>";
        echo "<p>Duration: {$row['duration']} seconds</p>";
        echo "<p>BPM: {$row['bpm']}</p>";
        echo "<p>Energy: {$row['energy']}</p>";
        echo "<p>Danceability: {$row['danceability']}</p>";
        echo "<p>Liveness: {$row['liveness']}</p>";
        echo "<p>Valence: {$row['valence']}</p>";
        echo "<p>Acousticness: {$row['acousticness']}</p>";
        echo "<p>Speechiness: {$row['speechiness']}</p>";
        echo "<p>Popularity: {$row['popularity']}</p>";
    } else {
        echo "<p>Song not found.</p>";
    }

    // Close the database connection
    $db = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="songinfo.css" />

    

</head>
<body>
<?php

generateHeader();
generateFooter();

?>


    <section></section>
    <footer></footer>

</body>
</html>













































