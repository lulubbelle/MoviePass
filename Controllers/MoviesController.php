<?php

namespace Controllers;

use DAO\MovieRepository as MovieRepository;

class MoviesController{

    public function ShowMovies(){
        // $movieRepo = new MovieRepository();
        // $movies = $movieRepo->GetAllFromDb();
        // var_dump($movies);
        // exit;
        include_once(VIEWS_PATH."workInProgress.php");
    }
    
    public function AddMovieToDatabase(){
        include_once(VIEWS_PATH."workInProgress.php");
    }
}
?>