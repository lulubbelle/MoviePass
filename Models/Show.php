<?php

namespace Models;


class Show{

    private $id;
    private $movieId;
    private $roomId;
    private $dateTimeFrom;
    private $dateTimeTo;
    private $active;

    //NotMapped
    private $movie;
    private $city;
    private $room;
    private $cinema;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getMovieId()
    {
        return $this->movieId;
    }

    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    public function getRoomId()
    {
        return $this->roomId;
    }

    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }
    
    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function getDateTimeFrom()
    {
        return $this->dateTimeFrom;
    }

    public function setDateTimeFrom($dateTimeFrom)
    {
        $this->dateTimeFrom = $dateTimeFrom;

        return $this;
    }

    public function getDateTimeTo()
    {
        return $this->dateTimeTo;
    }

    public function setDateTimeTo($dateTimeTo)
    {
        $this->dateTimeTo = $dateTimeTo;

        return $this;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    public function getCinema()
    {
        return $this->cinema;
    }

    public function setCinema($cinema)
    {
        $this->cinema = $cinema;

        return $this;
    }

    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $show = new Show();
            $show->setId($p['ID']);
            $show->setMovieId($p['MOVIE_ID']);
            $show->setRoomId($p['ROOM_ID']);
            $show->setDateTimeFrom($p['DATETIME_FROM']);
            $show->setDateTimeTo($p['DATETIME_TO']);
            $show->setActive($p['ACTIVE']);
            return $show;
        }, $value);

        if($resp != null){
            //return count($resp) > 1 ? $resp : $resp[0];
            return $resp;
        }
        else
            return array();
    }


}

?>