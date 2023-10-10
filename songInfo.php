<?php
require_once('config.inc.php');
include('helpers.inc.php');
include('db-classes.inc.php');


try{
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER,DBPASS));

    $songGateway = new SongDB($conn);
    $song = $songGateway -> generateSong();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMP 3512 Assign1</title>
    <link rel="stylesheet" href="songinfo.css" />
</head>
<body>
<?php

generateHeader();
generateFooter();
?>


    <section></section>
    <footer></footer>

</body>
</html>













































