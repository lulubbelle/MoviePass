<?php
    namespace Controllers;

    class RegisterController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."register.php");
        }        
    }

?>