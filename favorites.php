<?php
require_once('./includes/config.inc.php');
require_once('./includes/helpers.inc.php');
require_once('./includes/db-classes.inc.php');

session_start();
        if(isset($_GET['add'])){
            if(!isset($_SESSION['favorites'])){
                $_SESSION['favorites'] = [];
            }
    
            $favourites = $_SESSION['favorites'];
            $favourites[$_GET['add']] = $_GET['add']; 
            $_SESSION['favorites'] = $favourites;
            header("location: favorites.php"); 
        }   

        if(isset($_GET['remove'])){
            if(!isset($_SESSION['favorites'])){
                return;  
            }
    
            if($_GET['remove'] == 'all'){
                
                $_SESSION['favorites'] = [];
                header("location: favorites.php");
                return;
            }
    
            $favourites = $_SESSION['favorites'];
            unset($favourites[$_GET['remove']]); 
            $_SESSION['favorites'] = $favourites;
            
            header("location: favorites.php");
        }

        try{
            $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));
            $songGate = new SongDB($conn);
            
            $data = array();
            if(isset($_SESSION['favorites'])){
                $fav = getFavouriteSongIDs();
                if($fav == ""){
                    $data = array();
                }
                else if(substr_count($fav,",")>=1){
                    $data = $songGate -> getMulSongs($fav);
                }else{
                    $data = $songGate -> generateSong($fav);
                }
            }
    
            $pdo = null;
        }catch (Exception $e){
            die($e ->getMessage());
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
                        <?php echo "<a href='favorites.php?remove=all'><button class='rmAll'>Remove All</button></a>"; ?>
                    </th>
                    <th>View</th>
                </tr>
                <?php
                
                

               
                    foreach($data as $s){
                        
                            echo "<tr>
                                    <td>{$s['title']}</td>
                                    <td><?={$s['artist_name']}</td>
                                    <td><?={$s['year']}</td>
                                    <td><?={$s['genre_name']}</td>
                                    <td><?={$s['popularity']}</td>
                                    <td><a href='favorites.php?remove={$s['song_id']}'><button class='rm'>remove</button></a></td>
                                    <td><a href='songInfo.php?song_id={$s['song_id']}'><button class='vw'>view</button></a></td>
                                 </tr>"; 
                    }

                    
            

                
                 
                    
                ?>






            </table>

        </div>

    </section>
    <footer></footer>

</body>