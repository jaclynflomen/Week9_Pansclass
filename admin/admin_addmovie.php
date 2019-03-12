<?php

require_once('scripts/config.php');
confirm_logged_in();


//TODO: Pull all genres from tbl_genre
//save the results into an array $gen

$tbl_2 = 'tbl_genre';
$gen = getAll($tbl_2);

if(isset($_POST['submit'])){
    // var_dump($_POST);
    // var_dump($_FILES['cover']);
    $cover = $_FILES['cover'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $run = $_POST['run'];
    $story = $_POST['story'];
    $trailer = $_POST['trailer'];
    $release = $_POST['release'];
    $genre = $_POST['genList'];
    $result = addMovie($cover, $title, $year, $run, $story, $trailer, $release, $genre);
    $message = $result;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Movie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif;?>
    <form action="admin_addmovie.php" method="post" enctype="multipart/form-data">
        <label for="cover">Cover Image:</label>
        <input type="file" name="cover" id="cover" value=""><br><br>

        <label for="title">Movie Title:</label>
        <input type="text" name="title" id="title" value=""><br><br>

        <label for="year">Movie Year:</label>
        <input type="text" name="year" id="year" value=""><br><br>

        <label for="run">Movie Runtime:</label>
        <input type="text" name="run" id="run" value=""><br><br>

        <label for="trailer">Movie Trailer:</label>
        <input type="text" name="trailer" id="trailer" value=""><br><br>

        <label for="release">Movie Release:</label>
        <input type="text" name="release" id="release" value=""><br><br>

        <label for="story">Movie Storyline:</label>
        <textarea name="story" id="story"></textarea><br><br>

        <label for="genlist">Movie Genre:</label>
        <select name="genList" id="genlist">
        <option>Please select a movie genre..</option>
         <?php while($gens = $gen->fetch(PDO::FETCH_ASSOC)):?>    
            <option value="<?php echo $gens['genre_id'];?>">
                <?php echo $gens['genre_name'];?>
            </option>
            
            <?php endwhile; ?>
        </select><br><br>
        
        <button type="submit" name="submit">Add Movie</button>
    </form>
</body>
</html>