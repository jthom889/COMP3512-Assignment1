<?php
session_start();
require_once('./includes/config.inc.php');
require_once('./includes/helpers.inc.php');
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
        <?php echo "<a href='browse.php'><button class='return'>Return to Browse Results</button></a>"; 

        ?>
            <table>
                <tr>
                    <th>Song</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Popularity</th>
                    <th>
                        <?php echo "<a href='removeFavorites.php?RemAll=yes'><button class='rmAll'>Remove All</button></a>"; ?>
                    </th>
                    <th>View</th>
                </tr>
                <?php
                
                

                if(isset($_GET['song_id'])){
                    foreach($songs as $s){
                        
                            echo "<tr>
                                    <td>{$s['title']}</td>
                                    <td><?={$s['artist_name']}</td>
                                    <td><?={$s['year']}</td>
                                    <td><?={$s['genre_name']}</td>
                                    <td><?={$s['popularity']}</td>
                                    <td><a href='removeFavorites.php?song_id={$s['song_id']}'><button class='rm'>remove</button></a></td>
                                    <td><a href='songInfo.php?song_id={$s['song_id']}'><button class='vw'>view</button></a></td>
                                 </tr>"; }

                    
            }

                
                 
                    
                ?>






            </table>

        </div>

    </section>
    <footer></footer>

</body>