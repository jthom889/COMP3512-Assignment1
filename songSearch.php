<?php
require_once('./includes/config.inc.php');
include('./includes/helpers.inc.php');
require_once('./includes/db-classes.inc.php');


try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
    $songGateway = new SongDB($conn);


    $artistGateway = new ArtistDB($conn);
    $artists = $artistGateway -> getAll();

    $genreGateway = new GenreDB($conn);
    $genres = $genreGateway -> getAll();
    


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Song Information</title>
    <link rel="stylesheet" href="css/songSearch.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>
<body>
    <?php
    generateHeader();
    generateFooter();

    ?>
    <section>
    <div class="form-container">
        <h2>Search Songs</h2>
        <form action="browse.php" method="GET">
            <label for="title">
                <input type="radio" name="search_type" value="title" action='selected'> Title
               <?php echo "<input type='text' name='title' id='song_id'>"; ?>
            </label>
            <br>
            <label for="artist">
                <input type="radio" name="search_type" value="artist"> Artist
                <select name="artist" id="artist">
                    <option value='0'>Select Artist</option>
                        <?php 
                        
                            foreach($artists as $artist){
                            $selected = ($_GET['artist_name'] == $artist['artist_id']) ? 'selected' : '';
                            echo "<option value='{$artist['artist_id']}' $selected>{$artist['artist_name']}</option>";

                            }  
                        
                        ?>
                </select>
            </label>

            <label for="genre">
                <input type="radio" name="search_type" value="genre"> Genre
                <select name="genre" id="genre">
                    <option value="0">Select Genre</option>
                    <?php 
                    
                        foreach($genres as $genre){
                        $selected = ($_GET['genre_name'] == $genre['genre_id']) ? 'selected' : '';
                        echo "<option value='{$genre['genre_id']}' $selected>{$genre['genre_name']}</option>";

                        }  
                
                    ?>
                    
                </select>
            </label>
            <br>
            <label for="year">
                <input type="radio" name="search_type" value="year"> Year
                <?php 
                echo "<input type='text' name='year_after' placeholder='After'>";
                echo "<input type='text' name='year_before' placeholder='Before'>";
                ?>
            </label>
            <input type="submit" value="Search">
        </form>
    </div>
</section>
</body>
</html>



