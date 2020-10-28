<?php
    namespace Controllers;
    
    use DAO\CineRepository as CineRepository;
    use DAO\CityRepository as CityRepository;
    use DAO\RoomRepository as RoomRepository;
    use Models\Cine as Cine;
    use Models\Room as Room;

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

        public function RoomListShowView($message = "")
        {
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_GET){
                $cineId = $_GET["cineId"];
                
                $roomRepo = new RoomRepository();

                $rooms = $roomRepo->getAllRoomsByCinemaId($cineId);
                
                require_once(VIEWS_PATH."roomList.php");
            }
        }  

        public function RoomAddView($message = "")
        {
            require_once(UTILS_PATH."CheckAdmin.php");

            if($_GET){
                $cineId = $_GET["cineId"];
            }

            require_once(VIEWS_PATH."roomAbm.php");
        }

        public function AddRoom()
        {
            require_once(UTILS_PATH."CheckAdmin.php");

            if($_POST)
            {
                $cinemaId = $_POST["cinemaId"];
                $name = $_POST["name"];
                $capacity = $_POST["capacity"];

                $room = new Room();
                $room->setCinemaId($cinemaId);            
                $room->setName($name);
                $room->setCapacity($capacity);

                $roomRepo = new RoomRepository();

                $errorAbmRoom = $roomRepo->Add($room);

                if(!empty($errorAbmRoom))
                {                    
                    include_once(VIEWS_PATH."roomAbm.php");
                }else
                {
                    $this->Index();
                }
            
            }
        }

        public function UpdateRoomShowView(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_GET){
                $roomId = $_GET["id"];
                
                $roomRepo = new RoomRepository();

                $room = $roomRepo->GetById($roomId);
                
                require_once(VIEWS_PATH."roomAbm.php");
            }
        }

        public function UpdateRoom(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_POST){

                $id = $_POST["id"];
                $capacity = $_POST["capacity"];
                $name = $_POST["name"];
                $cinemaId = $_POST["cinemaId"];

                $room = new Room();
                $room->setId($id); 
                $room->setCinemaId($cinemaId);        
                $room->setName($name);
                $room->setcapacity($capacity);

                $roomRepo = new RoomRepository();

                $updateMsg = $roomRepo->UpdateRoom($id, $room);
                $this->Index(null,$updateMsg);
            }
        }

        public function DeleteRoom(){
            require_once(UTILS_PATH."CheckAdmin.php");
            if($_GET){
                $id = $_GET["id"];
                
                $roomRepo = new RoomRepository();

                $deleteMsg = $roomRepo->DeleteRoom($id);

                $this->Index($deleteMsg);
            }
        }

    }
?>