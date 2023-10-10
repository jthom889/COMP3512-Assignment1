<?php

class DatabaseHelper{

   
    public static function createConnection( $values=array() ) {
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString,$user,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC);
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

    private static $baseSQL = "SELECT title, artist_name as name, artist_type as type, genre_name as genre, year, SEC_TO_TIME(duration) as duration,
    bpm, energy, danceability, loudness, liveness, valence, duration, acousticness, speechiness, popularity,
    songs.artist_type_id, songs.genre_id, song_id,
    FROM songs";

    function generateSong($songID){
        $sql = self::$baseSQL . "WHERE song_id = $songID";
        $results = DatabaseHelper::runBasicQuery($this->pdo, $sql);
        return $results -> fetchAll();
    }



}












?>