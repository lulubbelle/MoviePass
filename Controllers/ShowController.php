<?php

namespace Controllers;

use Utils\Utils as Utils;
use Models\Show as Show;

use DAO\MovieRepository as MovieRepository;
use DAO\CityRepository as CityRepository;
use DAO\CinemaRepository as CinemaRepository;
use DAO\RoomRepository as RoomRepository;
use DAO\ShowRepository as ShowRepository;
use DAO\GenreRepository as GenreRepository;

class ShowController{

    public function Index($successMsg = ""){
        Utils::CheckAdmin();
        
        if(isset($_GET['cinemaId'])){
            if($successMsg == $_GET['cinemaId'])
            {
                $successMsg = "";
            }
            $shows = $this->GetShowsWithAllData(Utils::CleanInput($_GET['cinemaId']));
        }else{
            $shows = $this->GetShowsWithAllData();
        }
        $cinemaRepo = new CinemaRepository();
        $cinemas = $cinemaRepo->GetAll();

        include_once(VIEWS_PATH."showList.php");
    }

    public function ShowAddShowView($movieId = 0, $errorAbmShow = ""){
        Utils::CheckAdmin();
        if($_GET || $movieId != 0){
            $movieId = $movieId != 0 ? $movieId : Utils::CleanInput($_GET['movieId']);    
            
            $movieRepo = new MovieRepository();
            $movie = $movieRepo->GetById($movieId);
            
            $cityRepo = new CityRepository();
            $cities = $cityRepo->GetAll();

            include_once(VIEWS_PATH."addShow.php");
        }
    }

    public function ShowBillboardView($errorMsg = ""){
        Utils::CheckSession();
        
        $shows = $this->GetShowsWithAllData();
        // var_dump($shows);
        // exit;
        $genreRepo = new GenreRepository();

        $genres = $genreRepo->getAll();

        include_once(VIEWS_PATH."billboard.php");
    }

    public function GetShowsByCinemaIdAndDateRange(){
        Utils::CheckSession();
        if($_GET){
            $dateFrom = $_GET['dateTimeFrom'];
            $dateTo = $_GET['dateTimeTo'];
            $cinemaId = $_GET['cinemaId'];

            if($dateTo < $dateFrom){
                $this->Index("Debe ingresar una 'Fecha Hasta' mayor a la 'Fecha Desde'");
            }

            $showsRepo = new ShowRepository();
            $shows = $showsRepo->GetShowsByCinemaIdAndDateRange($dateFrom, $dateTo, $cinemaId);

            $movieRepo = new MovieRepository();
            $cityRepo = new CityRepository();
            $roomRepo = new RoomRepository();
            $cinemaRepo = new CinemaRepository();
    
            foreach($shows as $value){
                $movie = $movieRepo->GetById($value->getMovieId());
                $value->setMovie($movie);
    
                $city = $cityRepo->GetCityByRoomId($value->getRoomId());
                $value->setCity($city);
                
                $room = $roomRepo->GetById($value->getRoomId());
    
                $value->setRoom($room);
                
                $cinema = $cinemaRepo->GetById($value->getRoom()->getCinemaId());
    
                $value->setCinema($cinema);
                
            }
            
            $genreRepo = new GenreRepository();
            $genres = $genreRepo->getAll();

            $cinemaRepo = new CinemaRepository();
            $cinemas = $cinemaRepo->GetAll();
    
            include_once(VIEWS_PATH."showList.php");
        }
        
    }

    public function GetShowsByGenreAndDateRange(){

        Utils::CheckSession();
        if($_GET){
            $dateFrom = $_GET['dateTimeFrom'];
            $dateTo = $_GET['dateTimeTo'];
            $genreId = $_GET['genreId'];
            
            if($dateTo < $dateFrom){
                $this->ShowBillboardView("Debe ingresar una 'Fecha Hasta' mayor a la 'Fecha Desde'");
            }

            $showsRepo = new ShowRepository();
            $shows = $showsRepo->GetShowsByGenreAndDateRange($dateFrom, $dateTo, $genreId);
            
            $movieRepo = new MovieRepository();
            $cityRepo = new CityRepository();
            $roomRepo = new RoomRepository();
            $cinemaRepo = new CinemaRepository();
    
            foreach($shows as $value){
                $movie = $movieRepo->GetById($value->getMovieId());
                $value->setMovie($movie);
    
                $city = $cityRepo->GetCityByRoomId($value->getRoomId());
                $value->setCity($city);
                
                $room = $roomRepo->GetById($value->getRoomId());
    
                $value->setRoom($room);
                
                $cinema = $cinemaRepo->GetById($value->getRoom()->getCinemaId());
    
                $value->setCinema($cinema);
                
            }
            
            $genreRepo = new GenreRepository();
            $genres = $genreRepo->getAll();

            include_once(VIEWS_PATH."billboard.php");
        }

    }


    public function MovieSearch(){
        Utils::CheckAdmin();
        if($_POST){
            $movieRepo = new MovieRepository();

            $genreId = Utils::CleanInput($_POST["genre"]);
            //TO DO: fixear este metodo para que traiga los shows por genero
            $shows = $movieRepo->GetAllByGenre($genreId);
            
            $genreRepo = new GenreRepository();

            $genres = $genreRepo->getAll();

            require_once(VIEWS_PATH."billboard.php");
        }
        
    }

    //Ajax Call
    public function LoadCinemas()
    {   
        Utils::CheckAdmin();
        if (isset($_POST["cityId"])) {
            $cityId = Utils::CleanInput($_POST["cityId"]);
            
            $cinemaRepo = new CinemaRepository();
            $cinemas = $cinemaRepo->GetByCity($cityId);
            
            $arrayToEncode = array();
            foreach($cinemas as $cinema){
            
                $values["id"] = $cinema->getId();
                $values["name"] = $cinema->getName();
                $values["address"] = $cinema->getAddress();
                $values["cityId"] = $cinema->getCityId();
    
                array_push($arrayToEncode, $values);
            }
    
            $json = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            echo "$" . $json . "%";
        }
        
    }
    //Ajax Call
    public function LoadRooms()
    {   
        Utils::CheckAdmin();
        if (isset($_POST["cinemaId"])) {
            $cinemaId = Utils::CleanInput($_POST["cinemaId"]);
            
            $roomRepo = new RoomRepository();
            $rooms = $roomRepo->getAllRoomsByCinemaId($cinemaId);
            
            $arrayToEncode = array();
            foreach($rooms as $room){
            
                $values["id"] = $room->getId();
                $values["cinemaId"] = $room->getCinemaId();
                $values["name"] = $room->getName();
                $values["price"] = $room->getPrice();
                
                array_push($arrayToEncode, $values);
            }
    
            $json = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            echo "$" . $json . "%";
        }
    }
    //Ajax Call
    public function LoadCitysForPurchase(){
        Utils::CheckSession();
        if(isset($_POST["movieId"])){
            $movieId = Utils::CleanInput($_POST["movieId"]);

            $showRepo = new ShowRepository();
            $citys = $showRepo->GetCitysForPurchase($movieId);
            
            $arrayToEncode = array();
            foreach($citys as $city){
            
                $values["id"] = $city->getId();
                $values["cityDesc"] = $city->getName();
                
                array_push($arrayToEncode, $values);
            }
    
            $json = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            echo "$" . $json . "%";
        }
    }
    //Ajax Call
    public function LoadShowsForPurchase(){
        Utils::CheckSession();
        if(isset($_POST["cityId"]) && isset($_POST["movieId"])){
            $cityId = Utils::CleanInput($_POST["cityId"]);
            $movieId = Utils::CleanInput($_POST["movieId"]);

            $showRepo = new ShowRepository();
            $shows = $showRepo->GetShowsForPurchaseByCityIdAndMovieId($cityId, $movieId);
            
            $arrayToEncode = array();
            foreach($shows as $show){
                $show = $this->GetShowDetails($show);

                $values["id"] = $show->getId();
                //Agregar datos segun txt
                $values["cinema"] = $show->getCinema()->getName();
                $values["date"] = $show->getDateTimeFrom() . " | " . $show->getDateTimeTo();
                $values["price"] = $show->getRoom()->getPrice();

                array_push($arrayToEncode, $values);
            }

            $json = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            echo "$" . $json . "%";
        }
    }

    public function AddShow(){
        Utils::CheckAdmin();
        if($_POST){
            $cityId = Utils::CleanInput($_POST['cityId']);
            $cinemaId = Utils::CleanInput($_POST['cinemaId']);
            $roomId = Utils::CleanInput($_POST['roomId']);
            $dateTimeFrom = Utils::CleanInput($_POST['dateTimeFrom']);
            $movieId = Utils::CleanInput($_POST['movieId']);
            
            $movieRepo = new MovieRepository();
            $movie = $movieRepo->GetById($movieId);
            

            $show = new Show();
            $show->setMovieId($movieId);
            $show->setRoomId($roomId);
            $show->setDateTimeFrom($dateTimeFrom);

            $dateTo = Utils::AddMinutesToDateTime($dateTimeFrom, $movie->getDuration());
            $show->setDateTimeTo($dateTo);
            
            $validationErrors = $this->ValidateNewShow($show);
            
            if($validationErrors != ""){
                return $this->ShowAddShowView($movieId, $validationErrors);
            }

            $showRepo = new ShowRepository();
            $result = $showRepo->addOne($show);
            
            return $this->Index($result);
        }
    }

    public function DeleteShow(){
        if($_GET){
            $showId = Utils::CleanInput($_GET['id']);
            
            $showRepo = new ShowRepository();
            $result = $showRepo->DeleteShow($showId);
            
            return $this->Index($result);
        }
    }
    
    private function ValidateNewShow($show){

        $validationErrors = array();
      
        //Unica pelicula en todos los cines ese dia
        $showRepo = new ShowRepository();
        $result = $showRepo->GetByDateAndMovieId($show->getDateTimeFrom(), $show->getMovieId());
        
        if($result != null && count($result) > 0)
        {   
            $message = "<ul> <li>La pelicula indicada ya tiene funciones en otro cine en la fecha seleccionada.";
            
            $message = $message . "<ul>";

            foreach($result as $show){
                $show = $this->GetShowDetails($show);
                $message = $message . "<li> Cine: " . $show->getCinema()->getName() . "</li>";    
            }
            $message = $message . "</ul></li></ul>";

            array_push($validationErrors, $message);
        }

        $result = null;
        //Unica en las salas de ese cine cualquier dia
        $result = $showRepo->GetByRoomIdAndMovieId($show->getRoomId(), $show->getMovieId());
        
        if($result != null && count($result) > 0)
        {
            $message = "<ul><li>La pelicula indicada ya tiene funciones asignadas en otras salas de este cine.";
            
            $message = $message . "<ul>";

            foreach($result as $show){
                $show = $this->GetShowDetails($show);
                $message = $message . "<li> Sala: " . $show->getRoom()->getName() . "</li>";    
            }
            $message = $message . "</ul></li></ul>";
            
            array_push($validationErrors, $message);
        }

        $result = null;
        //Que si hay otra funcion en esa sala esta comience 15 minutos despues
        $result = $showRepo->GetShowByDatePlusMinutes($show->getDateTimeFrom(), MIN_TIME_BETWEEN_SHOWS);
        
        if($result != null && count($result) > 0)
        {
            //
            array_push($validationErrors, "<ul><li>El horario de comienzo de la funcion debe ser posterior a 15 minutos desde la ultima funcion en esta sala (" . $show->getDateTimeTo() . " + 15 mins).</li></ul>");
        }
        
        $result = null;
        //Validar que no haya una en la que coincida el horario de esta
        $result = $showRepo->GetShowIsPlayingInDateTime($show->getDateTimeFrom());
        
        if($result != null && count($result) > 0)
        {
            array_push($validationErrors, "<ul><li>Ya existe otra funcion para este horario en esta sala (" . $show->getDateTimeFrom() . ").</li></ul>");
        }
        
        return join(" <br>", $validationErrors);
    }

    private function GetShowsWithAllData($cinemaId = null){

        $showRepo = new ShowRepository();

        if($cinemaId == null){
            $shows = $showRepo->GetAll();
        }else{
            $shows = $showRepo->GetByCinemaId($cinemaId);
        }

        $movieRepo = new MovieRepository();
        $cityRepo = new CityRepository();
        $roomRepo = new RoomRepository();
        $cinemaRepo = new CinemaRepository();

        foreach($shows as $value){
            $movie = $movieRepo->GetById($value->getMovieId());
            $value->setMovie($movie);

            $city = $cityRepo->GetCityByRoomId($value->getRoomId());
            $value->setCity($city);
            
            $room = $roomRepo->GetById($value->getRoomId());

            $value->setRoom($room);
            
            $cinema = $cinemaRepo->GetById($value->getRoom()->getCinemaId());

            $value->setCinema($cinema);
            
        }
        return $shows;
    }

    private function GetShowDetails(Show $show){
        
        $movieRepo = new MovieRepository();
        $cityRepo = new CityRepository();
        $roomRepo = new RoomRepository();
        $cinemaRepo = new CinemaRepository();

        $movie = $movieRepo->GetById($show->getMovieId());
        $show->setMovie($movie);

        $city = $cityRepo->GetCityByRoomId($show->getRoomId());
        $show->setCity($city);
        
        $room = $roomRepo->GetById($show->getRoomId());

        $show->setRoom($room);
        
        $cinema = $cinemaRepo->GetById($show->getRoom()->getCinemaId());

        $show->setCinema($cinema);
        
        return $show;
    }

}

?>