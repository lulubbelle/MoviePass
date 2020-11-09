<?php

namespace Controllers;

use Utils\Utils as Utils;
use Models\Show as Show;

use DAO\MovieRepository as MovieRepository;
use DAO\CityRepository as CityRepository;
use DAO\CinemaRepository as CinemaRepository;
use DAO\RoomRepository as RoomRepository;
use DAO\ShowRepository as ShowRepository;

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

    public function ShowBillboardView(){
        Utils::CheckAdmin();
        
        $shows = $this->GetShowsWithAllData();

        include_once(VIEWS_PATH."billboard.php");
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
            array_push($validationErrors, "La pelicula indicada ya tiene funciones en otro cine en la fecha seleccionada.");
        }

        $result = null;
        //Unica en las salas de ese cine cualquier dia
        $result = $showRepo->GetByRoomIdAndMovieId($show->getRoomId(), $show->getMovieId());
        
        if($result != null && count($result) > 0)
        {
            array_push($validationErrors, "La pelicula indicada ya tiene funciones asignadas en otras salas de este cine.");
        }

        $result = null;
        //Que si hay otra funcion en esa sala esta comience 15 minutos despues
        $result = $showRepo->GetShowByDatePlusMinutes($show->getDateTimeFrom(), MIN_TIME_BETWEEN_SHOWS);
        
        if($result != null && count($result) > 0)
        {
            array_push($validationErrors, "El horario de comienzo de la funcion debe ser posterior a 15 minutos desde la ultima funcion en esta sala.");
        }
        
        $result = null;
        //Validar que no haya una en la que coincida el horario de esta
        $result = $showRepo->GetShowIsPlayingInDateTime($show->getDateTimeFrom());
        
        if($result != null && count($result) > 0)
        {
            array_push($validationErrors, "Ya existe otra funcion para este horario en esta sala.");
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
        // var_dump($shows);
        // exit;

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

}

?>