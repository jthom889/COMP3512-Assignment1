<?php
include('./includes/helpers.inc.php')


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Song Information</title>
    <link rel="stylesheet" href="css/songSearch.css" />
    <link rel="stylesheet" href="css/songinfo.css" />
</head>
<body>
    <?php
    generateHeader();
    generateFooter();

    ?>
    <div class="form-container">
        <h2>Search Songs</h2>
        <form action="browse.php" method="GET">
            <label for="title">
                <input type="radio" name="search_type" value="title"> Title
                <input type="text" name="title" id="title">
            </label>
            <br>
            <label for="artist">
                <input type="radio" name="search_type" value="artist"> Artist
                <select name="artist" id="artist">
                    <option value="artist1">Artist 1</option>
                    <option value="artist2">Artist 2</option>
                    <option value="artist3">Artist 3</option>
                </select>
            </label>

            <label for="genre">
                <input type="radio" name="search_type" value="genre"> Genre
                <select name="genre" id="genre">
                    <option value="genre1">Genre 1</option>
                    <option value="genre2">Genre 2</option>
                    <option value="genre3">Genre 3</option>
                </select>
            </label>
            <br>
            <label for="year">
                <input type="radio" name="search_type" value="year"> Year
                <input type="text" name="year" id="year">
            </label>

            <label for="year_range">
                <input type="radio" name="search_type" value="year_range"> Year Range
                <input type="text" name="year_less" placeholder="Less than">
                <input type="text" name="year_greater" placeholder="Greater than">
            </label>

            <input type="submit" value="Search">
        </form>
    </div>
</body>
</html>

</html>

