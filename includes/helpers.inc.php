<?php

function generateHeader(){
    echo 
    
"<header>
    <div class='dropdown-container'>
        <div class='dropdown-img'></div>
            <div class='dropdown-content'>
                <a href='homePage.php'>Home</a>
                <a href='browse.php'>Browse</a>
                <a href='songSearch.php'>Search</a>
                <a href='favorites.php'>Favourites</a>
                <a href='aboutUs.php'>About Us</a>
            </div>
        </div>
    </div>
</header>";
}

function generateFooter(){

    echo 
    
        '<div class="footer">
            <div class="footer-left">
                <p> Jonah Thompson  &  Ethan Koop </p>   
            </div>
            <div class="footer-centre">
                <p> COMP-3512 </p>
            </div>
            <div class="footer-right">
                <p>  Repo:  <a href="https://github.com/jthom889/COMP3512-Assignment1.git">https://github.com/jthom889/COMP3512-Assignment1.git</a></p>
            </div>
        </div>';

}

function generateSongList($songs){
    
    echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";

        foreach($songs as $s){ ?>
            <tr>
                <td class='title'><a href='songinfo.php?song_id=<?=$s['song_id']?>'><?=$s['title']?></a></td>
                <td><?=$s['artist_name']?></td>
                <td><?=$s['year']?></td>
                <td><?=$s['genre_name']?></td>
                <td><a href='addToFavorites.php?song_id=<?=$s['song_id']?>' ><button class='button'>Add</button></a></td>
                <td><a href='songinfo.php?song_id=<?=$s['song_id']?>' class='button'><button>View</button></a></td>

        <?php }
        echo "</table>";

}

function toMin($seconds){
    $minute = floor($seconds/60);
    $second = $seconds%60;

    if($second < 10){
        echo "$minute:0$second";
        
    }else{
        echo "$minute:$second";
    }
}

function outputSongs($songs){

    echo "<ul>";
    foreach($songs as $s){ ?>

        <li><span>
            <a href="songinfo.php?song_id=<?=$s['song_id']?>">
                <?=$s['title']?>
            </a> by <?=$s['artist_name']?>
        </li>
        <br>

    <?php }
    echo "</ul>";
}

function outputCatagories($catagories){

    echo "<ul>";
    foreach($catagories as $c) 
        echo "<li><span>" . $c['name'] . "</span> with " . $c['num'] . " songs</li><br>";
        
    echo "</ul>";
}

function outputFav($fav, $search){
    
    foreach($fav as $f){             
                        
    echo "<tr>
            <td>{$fav['title']}</td>
            <td><?={$fav['artist_name']}</td>
            <td><?={$fav['year']}</td>
            <td><?={$fav['genre_name']}</td>
            <td><?={$fav['popularity']}</td>
            <td><a href='removeFavorites.php?song_id={$fav['song_id']}&$search'><button class='rm'>remove</button></a></td>
            <td><a href='single-song.php?id={$fav['song_id']}'><button class='vw'>view</button></a></td>
         </tr>";
    }       
                    
}



?>