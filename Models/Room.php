<?php

namespace Models;

class Room {

    private $id;
    private $cinemaId;
    private $name;
    private $capacity;
    private $active;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCinemaId()
    {
        return $this->cinemaId;
    }

    public function setCinemaId($cinemaId)
    {
        $this->cinemaId = $cinemaId;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

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

    public static function mapData($value) {

        $value = is_array($value) ? $value : [];
   
        
        $resp = array_map(function($p){

            $room = new Room();
            $room->setId($p['id']);
            $room->setName($p['name']);
            $room->setActive($p['active']);
            
            return $room;
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