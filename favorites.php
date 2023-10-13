<?php
require_once('./includes/config.inc.php');
require_once('./includes/helpers.inc.php');
require_once('./includes/db-classes.inc.php');

session_start();

    if( !isset($_SESSION["Favorites"]) ){
        $_SESSION["Favorites"] = [];
    }

    $favorites = $_SESSION["Favorites"];

    $conn = DatabaseHelper::createConnection( array(DBCONNSTRING, DBUSER, DBPASS) );
    $songsGateway = new SongDB($conn);

    
    if( !empty($_GET["name"]) && !empty($_GET[$_GET["name"]]) ){
    $queryS = "name=" . $_GET['name'] . "&" . $_GET['name'] . "=" . $_GET[$_GET['name']];
    }else{
    $queryS = "";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/favorites.css" />
</head>
<body>

        <?php
            generateHeader();
            generateFooter();

        ?>
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
                
                if( !empty($_GET["text"]) ){
                    echo $_GET["text"]; 
                }

                
                foreach($favorites as $fav){
                    outputFav($songsGateway->generateSong($fav), $queryS);
                }

                echo "</table>";
                 
                    
                ?>






            </table>

        </div>

    </section>
    <footer></footer>

</body>