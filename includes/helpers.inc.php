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

    echo "
    
    <footer>

        <div class='lfoot'>
            <p> Jonah Thompson  &  Ethan Koop </p>   
        </div>
        <div class='cfoot'>
            <p> COMP-3512 </p>
        </div>
        <div class='rfoot'>
            <p>  Repo:  <a href='https://github.com/jthom889/COMP3512-Assignment1.git'>https://github.com/jthom889/COMP3512-Assignment1.git</a></p>
        </div>
    </footer>";

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
                <td><a href='favorites.php?song_id=<?=$s['song_id']?>' ><button class='button'>Add</button></a></td>
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


?>