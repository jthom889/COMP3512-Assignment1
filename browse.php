<?php
    require_once('./includes/config.inc.php');
    include('./includes/helpers.inc.php');
    include('./includes/db-classes.inc.php');

    try{
        $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
        $songGateway = new SongDB($conn);

        if(isset($_GET['title'])){

        } elseif(isset($_GET['artist_name'])){

        } elseif(isset($_GET['genre_name'])) {

        } elseif(isset($_GET['year'])){

        } elseif(isset($_GET['less']) && isset($_GET['more'])){

        } elseif(isset($_GET['less'])){

        } elseif(isset($_GET['more'])){
            
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
    
    

</body>