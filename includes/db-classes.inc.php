<?php

class DatabaseHelper{

   
    public static function createConnection( $values=array() ) {
        $connString = $values[0];
        $user = $values[1];
        $pass = $values[2];
        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
  
    public static function runQuery($connection, $sql, $parameters) {
        $statement = null;
        
        if (isset($parameters)) {
            
            if (!is_array($parameters)) {
                $parameters = array($parameters);
            }
            
            $statement = $connection->prepare($sql);
            $executedOk = $statement->execute($parameters);
            if (! $executedOk) throw new PDOException;
        } else {
            
            $statement = $connection->query($sql);
            if (!$statement) throw new PDOException;
        }
        return $statement;
    }
}

class SongDB{

    private static $baseSQL = "SELECT s.song_id, s.title, s.year, s.duration, s.bpm, s.energy, s.danceability, s.liveness, s.valence, s.acousticness, s.speechiness, s.popularity,
    a.artist_name, a.artist_type_id, g.genre_name
    FROM songs AS s 
    JOIN artists AS a ON s.artist_id = a.artist_id
    JOIN genres AS g ON s.genre_id = g.genre_id ";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getMulSongs($songID){
        //for multiple songs
        $sql = self::$baseSQL. ' WHERE song_id IN ('.$songID.')';
        $results = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $results -> fetchAll();
    }

    function generateSong($songID){
        $sql=  self::$baseSQL . " WHERE song_id =?";
    
        $results = DatabaseHelper::runQuery($this->pdo, $sql, Array($songID));
        return $results -> fetchAll();
    }

    function getAll(){
        $sql = self::$baseSQL;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getAllSongs(){
        $sql = self::$baseSQL . "ORDER by title";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getSongsByTitle($title){
        $sql = self::$baseSQL . " WHERE title LIKE ? ORDER BY title";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array('%' . $title . '%'));
        return $statement->fetchAll();
    }

    function getSongsByArtist($artist_name){
        $sql = self::$baseSQL . "WHERE artist_name =? ORDER BY s.title";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artist_name));
        return $statement->fetchAll();
    }

    function getSongsByGenre($genre_name){
        $sql = self::$baseSQL . "WHERE genre_name =? ORDER BY s.title";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genre_name));
        return $statement->fetchAll();
    }

    function getSongsByBefore($year){
        $sql = self::$baseSQL . "WHERE s.year <? ORDER BY year";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
        return $statement->fetchAll();
    }

    function getSongsByAfter($year){
        $sql = self::$baseSQL . "WHERE s.year >? ORDER BY year";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
        return $statement->fetchAll();
    }

    function getOneHits(){
        $sql = " SELECT song_id, artists.artist_name, title, popularity 
                 FROM songs JOIN artists USING (artist_id) 
                 GROUP BY artist_name 
                 HAVING COUNT(artist_name)=1 
                 ORDER BY popularity DESC LIMIT 10";
     
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getMostPopular(){
        $sql = self::$baseSQL . ' ORDER BY popularity DESC LIMIT 10';
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getLongestAcoustic(){
        $sql = "SELECT song_id, title, acousticness, duration, artist_name 
                FROM songs JOIN artists USING (artist_id)
                WHERE acousticness>40 
                ORDER BY duration DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getAtTheClub(){
        $sql = "SELECT song_id, title, danceability, artist_name, (danceability*1.6) + (energy*1.4) AS calc 
                FROM songs JOIN artists USING (artist_id)
                WHERE danceability>80 
                ORDER BY calc DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getRunning(){
        $sql = "SELECT song_id, title, bpm, artist_name, (energy*1.3) + (valence*1.6) AS calc 
                FROM songs JOIN artists USING (artist_id) 
                WHERE bpm BETWEEN 120 AND 125 
                ORDER BY calc DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getStudying(){
        $sql = "SELECT song_id, title, bpm, artist_name, speechiness, (acousticness*0.8) + (100-speechiness) + (100-valence) AS calc 
                FROM songs JOIN artists USING (artist_id) 
                WHERE (bpm BETWEEN 100 AND 115) 
                AND (speechiness BETWEEN 1 AND 20) 
                ORDER BY calc DESC LIMIT 10";  
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    

}

class ArtistDB{

    private static $baseSQL = "SELECT artist_id, artist_name FROM artists ";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll(){
        $sql = self::$baseSQL . "ORDER BY artist_name";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getArtist($artist_id){
        $sql = self::$baseSQL . " WHERE artist_id=?";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artist_id));
        return $statement->fetchAll();
    }

    function getTopArtists(){
        $sql = "SELECT artist_name AS name, COUNT(artists.artist_id) AS num 
                FROM artists JOIN songs USING (artist_id) 
                GROUP BY artists.artist_id 
                ORDER BY num DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

}

class GenreDB{

    private static $baseSQL = "SELECT genre_id, genre_name FROM genres ";

    public function __construct($connection) {
        $this->pdo = $connection;
    }

    public function getAll(){
        $sql = self::$baseSQL . "ORDER BY genre_name";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

    function getGenre($genre_id){
        $sql = self::$baseSQL . "WHERE genre_id=?";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genre_id));
        return $statement->fetchAll();
    }

    function getTopGenres(){
        $sql = "SELECT genre_name AS name, COUNT(songs.genre_id) AS num
                FROM songs JOIN genres USING (genre_id) 
                GROUP BY songs.genre_id 
                ORDER BY num DESC LIMIT 10";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }

}












?>