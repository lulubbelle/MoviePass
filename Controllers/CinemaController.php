<?php
    namespace Controllers;
    
    use DAO\CinemaRepository as CinemaRepository;
    use DAO\CityRepository as CityRepository;
    use DAO\RoomRepository as RoomRepository;
    
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Utils\Utils as Utils;

    class CinemaController
    {
        public function Index($deleteMsg = "", $successMsg = "")
        {
            Utils::CheckAdmin();

            $cineRepo = new CinemaRepository();
            $cityRepo = new CityRepository();

            $cinemas = $cineRepo->GetAll();
            $cities = $cityRepo->GetAll();

            require_once(VIEWS_PATH."cinemaList.php");
        }        

        public function CinemaAddView($errorAbmCine = "", $successMsg = "")
        {
            Utils::CheckAdmin();

            $cityRepository = new CityRepository();
            $cities = $cityRepository->GetAll();
            
            //TODO: quitar el TODOS del ABM de agregar Cine
            require_once(VIEWS_PATH."cinemaAbm.php");
        }     

        public function CinemaSearch(){
            Utils::CheckAdmin();
            if($_POST){
                $ciudad = $_POST["city"];

                $cineRepo = new CinemaRepository();
                $cityRepo = new CityRepository();
                //TODO: 
                if($ciudad == 7)
                {
                    $cinemas = $cineRepo->GetAll($ciudad);
                } else {
                    $cinemas = $cineRepo->GetByCity($ciudad);
                }
                
                $cities = $cityRepo->getAll();
                
                require_once(VIEWS_PATH."cinemaList.php");
            }
        }

        public function AddCine()
        {
            Utils::CheckAdmin();
            if($_POST)
            {
                $name = $_POST["name"];
                $address = $_POST["address"];
                $cityId = $_POST["cityId"];

                $cinema = new Cinema();
                $cinema->setName($name);
                $cinema->setAddress($address);
                $cinema->setCityId($cityId);

                $cineRepo = new CinemaRepository();

                $errorAbmCine = $cineRepo->AddOne($cinema);

                if(!empty($errorAbmCine) && $errorAbmCine != 1)
                {                    
                    $this->CinemaAddView($errorAbmCine);
                }else
                {
                    $this->Index();
                }
            
            }
        }

        public function DeleteCinema(){
            Utils::CheckAdmin();
            if($_GET){
                $cineId = $_GET["id"];
                
                $cineRepo = new CinemaRepository();

                $deleteMsg = $cineRepo->DeleteCinema($cineId);

                $this->Index($deleteMsg);
            }
        }

        
        public function UpdateCinemaShowView(){
            Utils::CheckAdmin();
            if($_GET){
                $cineId = $_GET["id"];
                
                $cineRepo = new CinemaRepository();

                $cinema = $cineRepo->GetById($cineId);
                
                require_once(VIEWS_PATH."cinemaAbm.php");
            }
        }

        
 
        public function UpdateCinema(){
            Utils::CheckAdmin();
            if($_POST){

                $cinemaId = $_POST["id"];
                $active = $_POST["active"];
                $nombre = $_POST["name"];
                $direccion = $_POST["address"];
                $cityId = $_POST["cityId"];

                $cinema = new Cinema();
                $cinema->setId($cinemaId);
                $cinema->setName($nombre);
                $cinema->setAddress($direccion);
                $cinema->setCityId($cityId);
                $cinema->setActive($active);
                
                $cineRepo = new CinemaRepository();

                $updateMsg = $cineRepo->Update($cinema);
                $this->Index(null,$updateMsg);
            }
        }

        public function RoomListShowView($message = "")
        {
            Utils::CheckAdmin();
            if($_GET){
                $cineId = $_GET["cineId"];
                
                $roomRepo = new RoomRepository();

                $rooms = $roomRepo->getAllRoomsByCinemaId($cineId);
                
                require_once(VIEWS_PATH."roomList.php");
            }
        }  

        public function RoomAddView($message = "")
        {
            Utils::CheckAdmin();

            if($_GET){
                $cineId = $_GET["cineId"];
            }

            require_once(VIEWS_PATH."roomAbm.php");
        }

        public function AddRoom()
        {
            Utils::CheckAdmin();

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
            Utils::CheckAdmin();
            if($_GET){
                $roomId = $_GET["id"];
                
                $roomRepo = new RoomRepository();

                $room = $roomRepo->GetById($roomId);
                
                require_once(VIEWS_PATH."roomAbm.php");
            }
        }

        public function UpdateRoom(){
            Utils::CheckAdmin();
            if($_POST){

                $id = $_POST["id"];
                $capacity = $_POST["capacity"];
                $name = $_POST["name"];
                $cinemaId = $_POST["cinemaId"];

                $room = new Room();
                $room->setId($id); 
                $room->setCinemaId($cinemaId);        
                $room->setName($name);
                $room->setCapacity($capacity);

                $roomRepo = new RoomRepository();

                $updateMsg = $roomRepo->UpdateRoom($room);
                
                $this->Index(null,$updateMsg);
            }
        }

        public function DeleteRoom(){
            Utils::CheckAdmin();
            if($_GET){
                $id = $_GET["id"];
                
                $roomRepo = new RoomRepository();

                $deleteMsg = $roomRepo->DeleteRoom($id);

                $this->Index($deleteMsg);
            }
        }

    }
?>