<?php
    namespace Controllers;

    class CinemaController
    {
        public function Index($message = "")
        {
            require_once(UTILS_PATH."CheckSession.php");
            require_once(VIEWS_PATH."cinemaList.php");
        }        

    }
?>