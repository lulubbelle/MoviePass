<?php
    namespace Controllers;

    use DAO\MovieRepository as MovieRepository;
    use DAO\GenreRepository as GenreRepository;

    class ApiMovieController
    {
        public function Index($message = "")
        {
            require_once(UTILS_PATH."CheckAdmin.php");
            $movieRepo = new MovieRepository();
    
            $movieList = $movieRepo->GetAllFromApi();
            
            $genreRepo = new GenreRepository();

            $genres = $genreRepo->getAll();

            require_once(VIEWS_PATH."apiMovieList.php");
        }           

        public function MovieSearch(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_POST){
                $movieRepo = new MovieRepository();
    
                $movieList = $movieRepo->GetAllByGenre($_POST["genre"]);
                
                $genreRepo = new GenreRepository();
    
                $genres = $genreRepo->getAll();
    
                require_once(VIEWS_PATH."apiMovieList.php");
            }
            
        }

    }
?>

