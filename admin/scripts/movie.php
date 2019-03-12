<?php 

function addMovie($cover, $title, $year, $run, $story, $trailer, $release, $genre) {
    //plan things out...

    try{
        //1. Build the DB connection
        include('connect.php');

        //2. Validate file
        $file_type = pathinfo($cover['name'], PATHINFO_EXTENSION);
        $accepted_types = array('gif', 'jpg', 'jpe', 'jpeg', 'png');
        if(!in_array($file_type, $accepted_types)){
            throw new Exception('Wrong file type!');
        }

        //3. Movie file around
        $target_path = '../images/' . $cover['name'];
        if(!movie_uploaded_file($cover['tmp_name'], $target_path)){
            throw new Exception('Failed to move uploaded file, check permission!');
        }

        //4. Adding entried to the db (both tbl_movies and tbl_mov_genre)

        //5. if all above works fine, redirect user to index.php

    }catch(Exception $e){
        $error = $e->getMessage();
        return $error;
    }

    var_dump($cover);

    var_dump($genre);
}

?>