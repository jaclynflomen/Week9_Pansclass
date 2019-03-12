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

        $th_copy = '../images/TH_' . $cover['name'];
        if(!copy($target_path, $th_copy)){
            throw new Exception('Failed to move copy file, check permission!');
        }

        //4. Adding entried to the db (both tbl_movies and tbl_mov_genre)
        $add_movies_query = 'INSERT INTO tbl_movies(movies_cover, movies_title, movies_year, movies_runtime, movies_storyline, movies_trailer, movies_release)';
		$add_movies_query .= ' VALUES(:movies_cover,:movies_title,:movies_year,:movies_runtime, :movies_storyline, :movies_trailer, :movies_release)';

		$add_movies = $pdo->prepare($add_movies_query);
		$add_movies->execute(
			array(
				':movies_cover'=>$cover['name'],
				':movies_title'=>$title,
				':movies_year'=>$year,
                ':movies_runtime'=>$run,
                ':movies_storyline'=>$story,
                ':movies_trailer'=>$trailer,
                ':movies_release'=>$release
                )
		);

        if(!$add_movies){
            throw new Exception('Failed to insert the new movie!');
        }
        $last_id = $pdo->lastInsertId();
        
        $insert_genre_query = 'INSERT INTO tbl_mov_genre(movies_id, genre_id) VALUES(:movies_id, :genre_id)';
        $insert_genre = $pdo->prepare($insert_genre_query);
        $insert_genre->execute(
            array(
                ':movies_id'=>$last_id,
                ':genre_id'=>$genre
            )
            );


		if(!$insert_genre->rowCount()){
			throw new Exception('Failed to set genre!');
        }
        
        //5. if all above works fine, redirect user to index.php
        redirect_to('index.php');

    }catch(Exception $e){
        $error = $e->getMessage();
        return $error;
    }

    var_dump($cover);

    var_dump($genre);
}

?>