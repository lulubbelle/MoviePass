<?php
    namespace Controllers;

use Models\Show as Show;

use DAO\MovieRepository as MovieRepository;
use DAO\CityRepository as CityRepository;
use DAO\CinemaRepository as CinemaRepository;
use DAO\RoomRepository as RoomRepository;
use DAO\ShowRepository as ShowRepository;
use DAO\GenreRepository as GenreRepository;

class HomeController
{
    public function Index($message = "")
    {
            
        $shows = $this->GetShowsForHome();

        require_once(VIEWS_PATH."main.php");
    }   

    private function GetShowsForHome($cinemaId = null){

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

        $displayShows = array();

        for($i = 0; $i < 4; $i++){
            
            $value = $shows[$i];

            $movie = $movieRepo->GetById($value->getMovieId());
            $value->setMovie($movie);

            $city = $cityRepo->GetCityByRoomId($value->getRoomId());
            $value->setCity($city);
            
            $room = $roomRepo->GetById($value->getRoomId());

            $value->setRoom($room);
            
            $cinema = $cinemaRepo->GetById($value->getRoom()->getCinemaId());

            $value->setCinema($cinema);      
            
             array_push($displayShows, $value);

        }

        return $displayShows;
    }
}

?>