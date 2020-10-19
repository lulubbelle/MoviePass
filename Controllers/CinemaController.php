<?php
    namespace Controllers;

    class CinemaController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."cinemaList.php");
        }        

    }
?>