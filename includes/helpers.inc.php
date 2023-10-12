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
                <a href='favourites.php'>Favourites</a>
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

function generateSongList(){
    
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