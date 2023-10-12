<?php
    require_once('./includes/config.inc.php');
    include('./includes/helpers.inc.php');
    include('./includes/db-classes.inc.php');

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new SongDB($conn);

        if(isset($_GET['title'])){
            $song = $songGateway->getSongsByTitle($_GET['title']);


        } elseif(isset($_GET['artist'])){
            $song = $songGateway->getSongsByArtist($_GET['artist']);

        } elseif(isset($_GET['genre'])) {
            $song = $songGateway->getSongsByGenre($_GET['genre']);

        } elseif(isset($_GET['year_after'])){
            $song = $songGateway->getSongsByafter($_GET['year_after']);

        } elseif(isset($_GET['year_before'])){
            $song = $songGateway->getSongsBybefore($_GET['year_before']);
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Browse</title>
    <link rel="stylesheet" href="css/main.css" />
    
</head>
<body>
    <?php
        generateHeader();
        generateFooter();
    ?>
    <div class="headliner">
        <h1>Search/Brwose Results</h1>
    </div>
    
    

</body>