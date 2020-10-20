<?php

namespace Controllers;

class MoviesController{

    public function ShowMovies(){
        include_once(VIEWS_PATH."workInProgress.php");
    }
    
    public function AddMovieToDatabase(){
        include_once(VIEWS_PATH."workInProgress.php");
    }
}
?>