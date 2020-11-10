<?php
    namespace Controllers;
    
    use DAO\CinemaRepository as CinemaRepository;
    use DAO\CityRepository as CityRepository;
    use DAO\RoomRepository as RoomRepository;
    use DAO\ShowRepository;
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
                
                //TODO: Fix hardcoding
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
                $name = Utils::CleanInput($_POST["name"]);
                $address = Utils::CleanInput($_POST["address"]);
                $cityId = Utils::CleanInput($_POST["cityId"]);

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
                $deleteMsg = $this->ValidateDeleteCinema($cineId);
                if($deleteMsg != null){
                    
                    $this->Index($deleteMsg);
                }else{
                    $deleteMsg = $cineRepo->DeleteCinema($cineId);

                    $this->Index($deleteMsg);
                }
            }
        }

        
        public function UpdateCinemaShowView(){
            Utils::CheckAdmin();
            if($_GET){
                $cineId = $_GET["id"];
                
                $cineRepo = new CinemaRepository();

                $cinema = $cineRepo->GetById($cineId);
                
                $cityRepo = new CityRepository();
                $cities = $cityRepo->getAll();

                require_once(VIEWS_PATH."cinemaAbm.php");
            }
        }

        
 
        public function UpdateCinema(){
            Utils::CheckAdmin();
            if($_POST){

                $cinemaId = Utils::CleanInput($_POST["id"]);
                $active = Utils::CleanInput($_POST["active"]);
                $nombre = Utils::CleanInput($_POST["name"]);
                $direccion = Utils::CleanInput($_POST["address"]);
                $cityId = Utils::CleanInput($_POST["cityId"]);

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

        public function RoomListShowView($cinemaId, $message = "")
        {
            Utils::CheckAdmin();

            $parameterCall = (isset($cinemaId) && !empty($cinemaId));
            $successMsg = $message;
            if($_GET || $parameterCall){

                $cineId = $parameterCall ? $cinemaId : $_GET["cineId"];
                
                $roomRepo = new RoomRepository();
                $cineRepo = new CinemaRepository();

                $rooms = $roomRepo->getAllRoomsByCinemaId($cineId);
                $cinema = $cineRepo->GetById($cineId);

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
                $cinemaId = Utils::CleanInput($_POST["cinemaId"]);
                $name = Utils::CleanInput($_POST["name"]);
                $capacity = Utils::CleanInput($_POST["capacity"]);
                $price = Utils::CleanInput($_POST["price"]);

                $room = new Room();
                $room->setCinemaId($cinemaId);            
                $room->setName($name);
                $room->setCapacity($capacity);
                $room->setPrice($price);

                $roomRepo = new RoomRepository();

                $errorAbmRoom = $roomRepo->Add($room);

                if(!empty($errorAbmRoom))
                {                    
                    include_once(VIEWS_PATH."roomAbm.php");
                }else
                {
                    $this->RoomListShowView($cinemaId);
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

                $id = Utils::CleanInput($_POST["id"]);
                $capacity = Utils::CleanInput($_POST["capacity"]);
                $name = Utils::CleanInput($_POST["name"]);
                $price = Utils::CleanInput($_POST["price"]);
                $cinemaId = Utils::CleanInput($_POST["cinemaId"]);

                $room = new Room();
                $room->setId($id); 
                $room->setCinemaId($cinemaId);        
                $room->setName($name);
                $room->setCapacity($capacity);
                $room->setPrice($price);

                $roomRepo = new RoomRepository();

                $updateMsg = $roomRepo->UpdateRoom($room);
                
                $room = $roomRepo->GetById($id);

                $this->RoomListShowView($room->getCinemaId(), $updateMsg);
            }
        }

        public function DeleteRoom(){
            Utils::CheckAdmin();
            if($_GET){
                $id = $_GET["id"];
                
                $roomRepo = new RoomRepository();
                $room = $roomRepo->GetById($id);
                
                $deleteMsg = $this->ValidateDeleteRoom($id);
                
                if($deleteMsg != null){
                    $this->RoomListShowView($room->getCinemaId(), $deleteMsg);    
                }else{
                    $deleteMsg = $roomRepo->DeleteRoom($id);

                    $this->RoomListShowView($room->getCinemaId(), $deleteMsg);
                }
            }
        }

        public function ValidateDeleteRoom($id){
            
            $showRepo = new ShowRepository();
            $hasShows = $showRepo->ValidateDeleteRoom($id);
           
            if(count($hasShows) > 0)
            {
                return "No se permite eliminar la sala ya que tiene funciones asociadas";
            }else{
                return null;
            }
        }
        
        public function ValidateDeleteCinema($id){
            
            $roomRepo = new RoomRepository();
            $hasRooms = $roomRepo->ValidateDeleteCinema($id);
            
            if(count($hasRooms) > 0)
            {
                return "No se permite eliminar el cine ya que tiene salas asociadas.";
            }else{
                return null;
            }
        }
        
    }
?>