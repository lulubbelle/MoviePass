<?php

namespace Models;

class Purchase{

    private $id;
    private $movieId;
    private $roomId;
    private $showId;
    private $ticketQuantity;
    private $active;
    
    //Not Mapped
    //MovieId
    private $movieTitle;
    private $movieDescription;
    private $moviePhoto;
    //RoomId
    private $price;
    private $roomName;
    private $cinemaName;
    private $cinemaAddress;
    private $cityDescription;
    //ShowId
    private $date;
    private $time;   
    
    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $purchase = new Purchase();
            $purchase->setId($p['ID']);
            $purchase->setMovieId($p['MOVIE_ID']);
            $purchase->setRoomId($p['ROOM_ID']);
            $purchase->setShowId($p['SHOW_ID']);
            $purchase->setTicketQuantity($p['TICKET_QUANTITY']);
            $purchase->setActive($p['ACTIVE']);
            return $purchase;

        }, $value);

        if($resp != null){
            return $resp;
        }
        else
            return array();
    }
    
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

    public function getShowId()
    {
        return $this->showId;
    }

    public function setShowId($showId)
    {
        $this->showId = $showId;

        return $this;
    }

    public function getTicketQuantity()
    {
        return $this->ticketQuantity;
    }

    public function setTicketQuantity($ticketQuantity)
    {
        $this->ticketQuantity = $ticketQuantity;

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

    public function getMovieTitle()
    {
        return $this->movieTitle;
    }

    public function setMovieTitle($movieTitle)
    {
        $this->movieTitle = $movieTitle;

        return $this;
    }
 
    public function getMovieDescription()
    {
        return $this->movieDescription;
    }

    public function setMovieDescription($movieDescription)
    {
        $this->movieDescription = $movieDescription;

        return $this;
    }

    public function getMoviePhoto()
    {
        return $this->moviePhoto;
    }

    public function setMoviePhoto($moviePhoto)
    {
        $this->moviePhoto = $moviePhoto;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getRoomName()
    {
        return $this->roomName;
    }

    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;

        return $this;
    }

    public function getCinemaName()
    {
        return $this->cinemaName;
    }

    public function setCinemaName($cinemaName)
    {
        $this->cinemaName = $cinemaName;

        return $this;
    }

    public function getCinemaAddress()
    {
        return $this->cinemaAddress;
    }

    public function setCinemaAddress($cinemaAddress)
    {
        $this->cinemaAddress = $cinemaAddress;

        return $this;
    }

    public function getCityDescription()
    {
        return $this->cityDescription;
    }

    public function setCityDescription($cityDescription)
    {
        $this->cityDescription = $cityDescription;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }
}

?>