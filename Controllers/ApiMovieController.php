<?php
    namespace Controllers;

    use DAO\MovieRepository as MovieRepository;
    use DAO\GenreRepository as GenreRepository;
    use Utils\Utils as Utils;

    class ApiMovieController
    {
        public function Index($message = "")
        {
            Utils::CheckAdmin();
            $movieRepo = new MovieRepository();
    
            $movieList = $movieRepo->GetAllFromApi();
            var_dump($movieList);
            exit;
            $genreRepo = new GenreRepository();

            $genres = $genreRepo->getAll();

            require_once(VIEWS_PATH."apiMovieList.php");
        }           

        public function MovieSearch(){
            Utils::CheckAdmin();
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

