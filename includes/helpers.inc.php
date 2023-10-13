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
    
        '<footer>
        <div class="footer">
            <div class="footer-left">
                <p>Jonah Thompson  &  Ethan Koop</p>   
            </div>
            <div class="footer-centre">
                <p>COMP-3512</p>
            </div>
            <div class="footer-right">
                <p>Repo:  <a href="https://github.com/jthom889/COMP3512-Assignment1.git">https://github.com/jthom889/COMP3512-Assignment1.git</a></p>
            </div>
        </div>
        <?footer>';

}

function generateSongList($songs){
    
    echo "<div class='output'><table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Artist</th>";
        echo "<th>Year</th>";
        echo "<th>Genre</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";

        foreach($songs as $s){ ?>
        
            <tr> <?php
            $tit = $s['title'];
            if(strlen($tit) > 25){
                $short = substr($tit, 0, 23) . '&hellip;';
                ?><td class='title'><a href="songinfo.php?song_id=<?=$s['song_id']?>"><?=$short?></a></td> 
                <?php
            }
            else{
                ?> <td class='title'><a href="songinfo.php?song_id=<?=$s['song_id']?>"><?=$tit?></a></td> <?php
            }    
            ?>
            
                
                <td><?=$s['artist_name']?></td>
                <td><?=$s['year']?></td>
                <td><?=$s['genre_name']?></td>
                <td><a href='favorites.php?add=<?=$s['song_id']?>'><button class='button'>Add</button></a></td>
                <td><a href='songinfo.php?song_id=<?=$s['song_id']?>' class='button'><button>View</button></a></td>

        <?php }
        echo "</table></div>";

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

function getFavouriteSongIDs(){
    //returns a string of song ids fit for sql
    $string = "";

    if($_SESSION['favorites'] == 0){
        return $string; //return nothing if there no favourites
    }

    foreach($_SESSION['favorites'] as $id){
        $string .= $id.",";
    }

    return substr($string,0,-1);//remove the last comma for mysql format
}



?>