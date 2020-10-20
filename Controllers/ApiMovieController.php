<?php
    namespace Controllers;

    use DAO\MovieRepository as MovieRepository;

    class ApiMovieController
    {
        public function Index($message = "")
        {
            $repo = new MovieRepository();
    
            $data = $repo->getAllFromApi();
    
            require_once(VIEWS_PATH."apiMovieList.php");
        }           

    }
?>    namespace Controllers;
