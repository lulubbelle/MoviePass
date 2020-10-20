<?php
    namespace Controllers;

    use DAO\ProximamenteRepository as ProximamenteRepository;

    class ProximamenteController
    {

        public function Index($message = "")
        {
            $repo = new ProximamenteRepository();

            $data = $repo->getAllFromApi();

            require_once(VIEWS_PATH."proximamente.php");
        }        
       
    }

?>