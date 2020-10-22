<?php
    namespace Controllers;
    
    use DAO\CineRepository as CineRepository;
    use DAO\CityRepository as CityRepository;
    use Models\Cine as Cine;

    class CinemaController
    {
        public function Index($deleteMsg = "", $successMsg = "")
        {
            require_once(UTILS_PATH."CheckAdmin.php");

            $cineRepo = new CineRepository();
            $cityRepo = new CityRepository();

            $cines = $cineRepo->getAll();
            $cities = $cityRepo->getAll();

            require_once(VIEWS_PATH."cinemaList.php");
        }        

        public function CinemaAddView($message = "")
        {
            require_once(UTILS_PATH."CheckAdmin.php");
            require_once(VIEWS_PATH."cinemaAbm.php");
        }        

        public function CinemaSearch(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_POST){
                $ciudad = $_POST["ciudad"];

                $cineRepo = new CineRepository();
                $cityRepo = new CityRepository();

                $cines = $cineRepo->GetByCiudad($ciudad);
                $cities = $cityRepo->getAll();
                
                require_once(VIEWS_PATH."cinemaList.php");
            }
        }

        public function AddCine()
        {
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_POST)
            {
                $capacidad = $_POST["capacidad"];
                $nombre = $_POST["nombre"];
                $valorEntrada = $_POST["valorEntrada"];
                $direccion = $_POST["direccion"];
                $ciudad = $_POST["ciudad"];

                $cine = new Cine();
                $cine->setCapacidad($capacidad);
                $cine->setNombre($nombre);
                $cine->setValorEntrada($valorEntrada);
                $cine->setDireccion($direccion);
                $cine->setCiudad($ciudad);

                $cineRepo = new CineRepository();

                $errorAbmCine = $cineRepo->Add($cine);
                if(!empty($errorAbmCine))
                {                    
                    include_once(VIEWS_PATH."cinemaAbm.php");
                }else
                {
                    $this->Index();
                }
            
            }
        }

        public function DeleteCinema(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_GET){
                $cineId = $_GET["id"];
                
                $cineRepo = new CineRepository();

                $deleteMsg = $cineRepo->DeleteCinema($cineId);

                $this->Index($deleteMsg);
            }
        }

        
        public function UpdateCinemaShowView(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_GET){
                $cineId = $_GET["id"];
                
                $cineRepo = new CineRepository();

                $cinema = $cineRepo->GetById($cineId);
                
                require_once(VIEWS_PATH."cinemaAbm.php");
            }
        }

        
 
        public function UpdateCinema(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_POST){

                $cineId = $_POST["id"];
                $capacidad = $_POST["capacidad"];
                $nombre = $_POST["nombre"];
                $valorEntrada = $_POST["valorEntrada"];
                $direccion = $_POST["direccion"];
                $ciudad = $_POST["ciudad"];

                $cine = new Cine();
                $cine->setId($cineId);
                $cine->setCapacidad($capacidad);
                $cine->setNombre($nombre);
                $cine->setValorEntrada($valorEntrada);
                $cine->setDireccion($direccion);
                $cine->setCiudad($ciudad);

                $cineRepo = new CineRepository();

                $updateMsg = $cineRepo->UpdateCinema($cineId, $cine);
                $this->Index(null,$updateMsg);
            }
        }




    }
?>