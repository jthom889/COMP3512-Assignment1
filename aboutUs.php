<?php

require_once('./includes/config.inc.php');
require_once('./includes/helpers.inc.php');
require_once('./includes/db-classes.inc.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/songinfo.css" />
</head>
<body>
<?php
        generateHeader();
        generateFooter();
    ?> 
    <section>

        <div class="content">
            <div class="about"><p>About Us</p></div>
            <p>Welcome to the COMP-3512 music web-page. This page features several diffent abilities,
                 such as adding songs to a favourites list, removing songs from the list, searching for songs via different criteria,
                 viewing different songs page etc. This page was created using different php methods to come up with such fuctions.
                 A big portion of this was done through the use of the '$_GET' super global variable. </p>
            <div class="total">     
                <div class="link-left"><a href="https://github.com/jthom889/COMP3512-Assignment1.git">Git Repo</a></div> 
                <div class="link-center"><a href="https://github.com/jthom889">Jonah Thompson</a></div>     
                <div class="link-right"><a href="https://github.com/ethankoop">Ethan Koop</a></div>
            </div>
        </div>

    </section>

</body>
</html>