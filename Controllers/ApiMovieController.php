<?php
    namespace Controllers;

    class ApiMovieController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."apiMovieList.php");
        }        

    }
?>