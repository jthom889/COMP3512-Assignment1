<?php
require_once('./includes/config.inc.php');
include('./includes/helpers.inc.php');
require_once('./includes/db-classes.inc.php');

session_start();

    if( !isset($_SESSION["Favorites"]) ){
        $_SESSION["Favorites"] = [];
    }

    $favorites = $_SESSION["Favorites"];

    $conn = DatabaseHelper::createConnection( array(DBCONNSTRING, DBUSER, DBPASS) );
    $songsGateway = new SongDB($conn);

    // creates a query string containing the filtered search results
    if( isset($_GET["name"]) && isset($_GET[$_GET["name"]]) )
        $queryS = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    else
        $queryS = " ";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/favorites.css" />
</head>
<body>
    
    <header>
        <?php
            generateHeader();
            generateFooter();

        ?>
    </header>

    <section>

        

        <div class="table-container">
        <?php echo "<a href='browse.php?$queryS'><button class='return'>Return to Browse Results</button></a>"; ?>
            <table>
                <tr>
                    <th>Song</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Popularity</th>
                    <th>
                        <?php echo "<a href='removeFavorites.php?$queryS'><button class='rmAll'>Remove All</button></a>"; ?>
                    </th>
                    <th>View</th>
                </tr>
                <?php

                foreach($favorites as $favSong)
                    foreach($favSong as $fav){
                        
                            echo "<tr>
                                    <td>{$fav['title']}</td>
                                    <td><?={$fav['artist_name']}</td>
                                    <td><?={$fav['year']}</td>
                                    <td><?={$fav['genre_name']}</td>
                                    <td><?={$fav['popularity']}</td>
                                    <td><a href='remove-favorites.php?id={$fav['song_id']}'><button class='rm'>remove</button></a></td>
                                    <td><a href='single-song.php?id={$fav['song_id']}'><button class='vw'>view</button></a></td>
                                </tr>";
                        
                    }   
                    
                ?>






            </table>

        </div>

    </section>
    <footer></footer>

</body>