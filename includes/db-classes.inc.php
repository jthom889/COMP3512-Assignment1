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

    private static $baseSQL = "SELECT s.title, s.year, s.duration, s.bpm, s.energy, s.danceability, s.liveness, s.valence, s.acousticness, s.speechiness, s.popularity,
    a.artist_name, a.artist_type_id,
    g.genre_name
    FROM songs AS s
    JOIN artists AS a ON s.artist_id = a.artist_id
    JOIN genres AS g ON s.genre_id = g.genre_id
    WHERE s.song_id = :song_id";


    public function __construct($connection) {
        $this->pdo = $connection;
    }

    function generateSong($songID){
        $sql = "SELECT s.title, s.year, s.duration, s.bpm, s.energy, s.danceability, s.liveness, s.valence, s.acousticness, s.speechiness, s.popularity,
        a.artist_name, a.artist_type_id,
        g.genre_name
        FROM songs AS s
        JOIN artists AS a ON s.artist_id = a.artist_id
        JOIN genres AS g ON s.genre_id = g.genre_id
        WHERE s.song_id = :songID";
        $results = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $results -> fetchAll();
    }



}












?>