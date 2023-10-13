<?php
    require_once 'includes/config.inc.php';
    include 'includes/helpers.inc.php';
    require_once 'includes/db-classes.inc.php';

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
        $songGateway = new SongDB($conn);
        $artistGateway = new ArtistDB($conn);
        $genreGateway = new GenreDB($conn);

        

        if(!empty($_GET['title'])){
            $songs = $songGateway->getSongsByTitle($_GET['title']);
            

        } elseif(!empty($_GET['artist']) && $_GET['artist'] > 0){
            $artist = $artistGateway->getArtist($_GET['artist']);
            $songs = $songGateway->getSongsByArtist($artist[0]['artist_name']);
            
        } elseif(!empty($_GET['genre']) && $_GET['genre'] > 0) {
            $genre = $genreGateway->getGenre($_GET['genre']);
            $songs = $songGateway->getSongsByGenre($genre[0]['genre_name']);
           
        } elseif(!empty($_GET['year_after'])){
            $songs = $songGateway->getSongsByafter($_GET['year_after']);
           
        } elseif(!empty($_GET['year_before'])){
            $songs = $songGateway->getSongsBybefore($_GET['year_before']);
           
        } else{
            $songs = $songGateway->getAllSongs();
        }

        
        
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Browse</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
    
</head>
<body>
    <?php
        generateHeader();
        generateFooter();
    ?>
    <div class="headline">
        <h1>Search/Browse Results</h1>
    </div>
    <section>
        <?php  
            generateSongList($songs); 
             
        ?>
    </section>
        
    
    
    

</body>
</html>