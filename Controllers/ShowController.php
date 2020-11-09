<?php

namespace Controllers;

use Utils\Utils as Utils;
use DAO\MovieRepository as MovieRepository;
use DAO\CityRepository as CityRepository;
use DAO\CinemaRepository as CinemaRepository;
use DAO\RoomRepository as RoomRepository;

class ShowController{

    public function Index(){

        if($_GET){

        }

        include_once(VIEWS_PATH."addShow.php");
    }

    public function ShowAddShowView(){
        
        if($_GET){
            $movieId = Utils::CleanInput($_GET['movieId']);    
            
            $movieRepo = new MovieRepository();
            $movie = $movieRepo->GetById($movieId);
            
            $cityRepo = new CityRepository();
            $cities = $cityRepo->GetAll();

            include_once(VIEWS_PATH."addShow.php");
    
        }
    }

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

}

?>